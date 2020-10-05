$( document ).ready(function() {
    //console.log("jQuery esta funcionando");   

    MostrarProductos();    
    let edit = false;

    $("#home").on("click", function(){
      location. reload();
    });

    $("#titulo-form").html("Registrar Producto");

    $('#btn-buscar').on("click", function( event ) {
        event.preventDefault();
        let search = $('#search').val();
        
        if(search === ""){
            MostrarProductos();
        }else{
          $.ajax({
            url: "ajax/productoBuscarGlobal.php",
            data: { search },
            type: "POST",
            success: function (response) {
              //console.log(response);
              let template = "";
              
                if (!response.error) {
                  let productos = JSON.parse(response);
                  productos.forEach((producto) => {
                    template += `<tr productoId=${producto.id}>
                                    <td scope="col">${producto.id}</td>
                                    <td scope="col">${producto.nombre}</td>
                                    <td scope="col">${producto.descripcion}</td>
                                    <td scope="col">${producto.cantidad}</td>                                        
                                    <td scope="col" class="d-flex">                                                
                                        <button class="btn btn-warning btn mr-2 producto-editar"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger btn producto-eliminar"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>`;
                  });
                  $("#tbl-ptoductos > tbody").html(template);
                }              
            },
          });
        }   
        
    });

    //buscar productos
    $('#search').on('keyup', function( event ){
        let search = $(this).val();
        //console.log(search);
        $.ajax({
            url: 'ajax/productosBuscar.php',
            data: {search},
            type: 'POST',
            success: function (response) {
                //console.log(response);
                let template = "";               
                    if (!response.error) {  
                        let productos = JSON.parse(response);                       
                        productos.forEach((producto) => {
                          template += `<tr productoId=${producto.id}>
                                            <td scope="col">${producto.id}</td>
                                            <td scope="col">${producto.nombre}</td>
                                            <td scope="col">${producto.descripcion}</td>
                                            <td scope="col">${producto.cantidad}</td>                                        
                                            <td scope="col" class="d-flex">                                                
                                                <button class="btn btn-warning btn mr-2 producto-editar"><i class="fas fa-pen"></i></button>
                                                <button class="btn btn-danger btn producto-eliminar"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>`;                        
                        });
                        $('#tbl-ptoductos > tbody').html(template);                    
                    }  
                  }             
        });        
    });

    //Buscar Productos por id
    $('table#tbl-ptoductos').on("click","button.producto-editar", function(e) {
        e.preventDefault();      
        const element = $(this)[0].parentElement.parentElement;
        const id = $(element).attr('productoId');
        //console.log(element);
        //console.log(id);
        $.post('ajax/productoBuscarId.php', {id}, (response) => {
            //console.log(response);
            const producto = JSON.parse(response);
            $('#id').val(id);     
            $('#nombre').val(producto[0].nombre);
            $('#descripcion').val(producto[0].descripcion);
            $('#cantidad').val(producto[0].cantidad);
            edit = true;
            $('#btn-guardar').css("display", "none");
            $('#btn-actualizar').css("display", "block");          
            $("#titulo-form").html("Editar Producto");
        });
      
    });

    //Mostrar Productos
    function MostrarProductos() {
        $.ajax({
          url: 'ajax/productosLista.php',
          type: 'GET',          
          success: function(response) {
            ///console.log(response);            
            let productos = JSON.parse(response);
            //console.log(productos);
            let template = '';
            productos.forEach((producto) => {
                template += `<tr productoId=${producto.id}>
                                <td scope="col">${producto.id}</td>
                                <td scope="col">${producto.nombre}</td>
                                <td scope="col">${producto.descripcion}</td>
                                <td scope="col">${producto.cantidad}</td>                                        
                                <td scope="col" class="d-flex">
                                    <button class="btn btn-warning btn mr-2 producto-editar"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger btn producto-eliminar"><i class="fas fa-trash"></i></button>
                                    
                                </td>
                              </tr>`;
              
            });
            $('#tbl-ptoductos > tbody').html(template); 
            edit = false;
            $('#btn-actualizar').hide();
            $('#btn-guardar').show();
            $('#msg-error').hide();
            $("#titulo-form").html("Registrar Producto");
          }
        });
    }

    //Guardar y Actualizar Producto
    $('#form-producto').submit(function (e) {
        e.preventDefault();
        if($('#nombre').val() === '' || $('#descripcion').val() === '' || $('#cantidad').val() === ''){
            $('#msg-error').show('slow');
        }else{

          const postData = {
            id: $('#id').val(),
            nombre: $('#nombre').val(),
            descripcion: $('#descripcion').val(),
            cantidad: $('#cantidad').val()         
          };
          
          let url;
          let title;
          if(edit === false){
            url = 'ajax/productoAgregar.php';
            title = "Se guardo el porducto!!!";

          }
          else{
            url = 'ajax/productoEditar.php';
            title = "Se actualizo el producto!!!";
          }
          //console.log(postData);
          //console.log(url);
          $.post(url , postData, function(response) { 
            
              if (!response.error) {
                swal({                
                    icon: 'success',
                    title,                    
                    timer: 1500
                });
                //console.log(response);
              $('#form-producto').trigger('reset');
              MostrarProductos();
              }
              else{
                console.log("hubo un error");
                MostrarProductos();
              }          
          });
        }
        
    });   

    //Borrar Producto
    $('table#tbl-ptoductos').on("click","button.producto-eliminar", function(event) {
      const element = $(this)[0].parentElement.parentElement;
        //console.log(element);
        const id = $(element).attr("productoId");
        //console.log(id);
        swal({
          title: "Estas seguro que quieres borrarlo?",
          text:
            "Una vez que lo borres no podras recuperarlo",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {            
            $.post("ajax/productoBorrar.php", { id }, (response) => {
            MostrarProductos();
            });
            swal("El producto ha sido eliminado!!!", {
              icon: "success",
            });
          } else {
            swal("No se elimino el producto!");
          }
        });     
    });    
});

