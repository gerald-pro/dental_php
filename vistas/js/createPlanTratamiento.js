const PlanTratamiento = {
	// Cache de elementos DOM frecuentemente usados
	elements: {
		subtotal: $("#nuevosubTotalPlantratamiento"),
		total: $("#nuevoTotalPlantratamiento"),
		discount: $("#nuevoDescuento"),
		servicesList: $(".nuevoServicio"),
		hiddenSubtotal: $("#subtotalPlantratamiento"),
		hiddenTotal: $("#totalPlantratamiento"),
		servicesTable: $(".tablaPlantratamiento")
	},

	// Inicializar eventos y configuración
	init: function () {
		this.initDataTable();
		this.initEventListeners();
	},

	// Inicializar DataTable
	initDataTable: function () {
		this.elements.servicesTable.DataTable({
			"ajax": "ajax/datatable-plantratamiento.ajax.php",
			"deferRender": true,
			"retrieve": true,
			"processing": true,
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sSearch": "Buscar:",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				}
			}
		});
	},

	// Inicializar event listeners
	initEventListeners: function () {
		const self = this;

		// Agregar servicio
		$(".tablaPlantratamiento tbody").on("click", "button.agregarServicio", function () {
			self.handleAddService($(this));
		});

		// Quitar servicio
		$(document).on("click", "button.quitarServicio", function () {
			self.handleRemoveService($(this));
		});

		// Cambiar cantidad
		$(".formularioPlantratamiento").on("change", "input.nuevaCantidadServicio", function () {
			self.handleQuantityChange($(this));
		});

		// Cambiar descuento
		this.elements.discount.on("change", function () {
			self.calculateTotals();
		});
	},

	// Manejar la adición de un servicio
	handleAddService: function ($button) {
		const idServicio = $button.attr("idServicio");
		$button.removeClass("btn-primary agregarServicio").addClass("btn-default");

		const datos = new FormData();
		datos.append("idServicio", idServicio);

		$.ajax({
			url: "ajax/servicios.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: (response) => {
				if (response.stock === 0) {
					this.showErrorAlert("No hay stock disponible");
					$button.addClass("btn-primary agregarServicio");
					return;
				}

				this.addServiceToForm(response, idServicio);
				this.calculateTotals();
				this.updateServicesList();
			}
		});
	},

	// Agregar servicio al formulario
	addServiceToForm: function (serviceData, idServicio) {
		const serviceHtml = `
            <div class="row mb-3 servicio-item">
                <div class="col-md-5 col-sm-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio="${idServicio}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control nuevaNombreServicio" 
                               idServicio="${idServicio}" 
                               value="${serviceData.nombre}" 
                               readonly required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <input type="number" class="form-control nuevaCantidadServicio" 
                           min="1" value="1" 
                           stock="${serviceData.stock}" 
                           nuevoStock="${Number(serviceData.stock - 1)}" required>
                </div>
                <div class="col-md-4 col-sm-12 ingresoPrecio">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Bs.</span>
                        </div>
                        <input type="text" class="form-control nuevoPrecioServicio" 
                               precioReal="${serviceData.precio}" 
                               value="${serviceData.precio}" 
                               readonly required>
                    </div>
                </div>
            </div>`;

		this.elements.servicesList.append(serviceHtml);
	},

	// Calcular totales
	calculateTotals: function () {
		let subtotal = 0;

		// Sumar todos los precios
		$(".nuevoPrecioServicio").each(function () {
			subtotal += Number($(this).val());
		});

		// Aplicar descuento
		const descuentoPorcentaje = Number(this.elements.discount.val()) || 0;
		const descuentoValor = (subtotal * descuentoPorcentaje) / 100;
		const total = subtotal - descuentoValor;

		// Actualizar valores en el formulario
		this.elements.subtotal.val(subtotal.toFixed(2));
		this.elements.total.val(total.toFixed(2));
		this.elements.hiddenSubtotal.val(subtotal.toFixed(2));
		this.elements.hiddenTotal.val(total.toFixed(2));
	},

	// Manejar cambio de cantidad
	handleQuantityChange: function ($input) {
		const cantidad = Number($input.val());
		const stock = Number($input.attr("stock"));
		const precio = $input.parent().parent().find(".nuevoPrecioServicio");
		const precioUnitario = Number(precio.attr("precioReal"));

		if (cantidad > stock) {
			this.showErrorAlert(`La cantidad supera el Stock. Sólo hay ${stock} unidades disponibles.`);
			$input.val(1);
			precio.val(precioUnitario);
		} else {
			precio.val((precioUnitario * cantidad).toFixed(2));
		}

		this.calculateTotals();
		this.updateServicesList();
	},

	// Actualizar lista de servicios
	updateServicesList: function () {
		const servicios = [];

		$(".servicio-item").each(function () {
			const $item = $(this);
			servicios.push({
				id: $item.find(".nuevaNombreServicio").attr("idServicio"),
				nombre: $item.find(".nuevaNombreServicio").val(),
				cantidad: $item.find(".nuevaCantidadServicio").val(),
				stock: $item.find(".nuevaCantidadServicio").attr("nuevoStock"),
				precio: $item.find(".nuevoPrecioServicio").attr("precioReal"),
				total: $item.find(".nuevoPrecioServicio").val()
			});
		});

		$("#listaServicios").val(JSON.stringify(servicios));
	},

	handleRemoveService: function ($button) {
		const idServicio = $button.attr("idServicio");

		// Eliminar la fila del servicio en el formulario
		$button.closest(".servicio-item").remove();

		// Restablecer el botón de agregar servicio en la tabla de servicios
		const $addButton = $(`.tablaPlantratamiento tbody button[idServicio="${idServicio}"]`);
		$addButton.removeClass("btn-default").addClass("btn-primary agregarServicio");

		// Recalcular los totales y actualizar la lista de servicios
		this.calculateTotals();
		this.updateServicesList();
	},

	// Mostrar alertas de error
	showErrorAlert: function (message) {
		swal({
			title: "Error",
			text: message,
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}
};

// Inicializar cuando el documento esté listo
$(document).ready(function () {
	PlanTratamiento.init();
});