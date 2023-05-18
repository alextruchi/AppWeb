<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Fontawesome -->
  <link
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    rel="stylesheet"
  />
  <!-- Bootswatch Darkly Theme -->
  <link href="https://bootswatch.com/5/cosmo/bootstrap.min.css" rel="stylesheet" />
  <title>JS Todo List</title>

  <style>
    .completed {
      text-decoration: line-through;
      color: gray;
    }

    .caja {
      padding: 10px;
      text-align: center;
      font-weight: bold;
      background-color: yellow;

    }

    #importante {
      background-color: red;
    }

    #no-importante {
      background-color: yellow;
    }
  </style>

  <script>
    
function carga()
{ 
	posicion=0; elMovimiento=null;
	
	// IE
	if(navigator.userAgent.indexOf("MSIE")>=0 || navigator.userAgent.indexOf("Trident")>=0) navegador=0;
	// Otros
	else 
		navegador=1;
}

function evitaEventos(event)
{
	// Funcion que evita que se ejecuten eventos adicionales
	if(navegador==0)
	{
		window.event.cancelBubble=true;
		window.event.returnValue=false;
	}
	if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event, id)
{ 
	elMovimiento=document.getElementById(id);
	if(navegador==0)
	 { 
	 	cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;

		document.attachEvent("onmousemove", enMovimiento);
		document.attachEvent("onmouseup", finMovimiento);
	}
	if(navegador==1)
	{    
		cursorComienzoX=event.clientX+window.scrollX;
		cursorComienzoY=event.clientY+window.scrollY;
		document.addEventListener("mousemove", enMovimiento, true); 
		document.addEventListener("mouseup", finMovimiento, true);
	}
	
	elComienzoX=parseInt(elMovimiento.style.left);
	elComienzoY=parseInt(elMovimiento.style.top);
	// Actualizo el posicion del elemento
	elMovimiento.style.zIndex=++posicion;
	evitaEventos(event);
}

function enMovimiento(event)
{  
	var xActual, yActual;
	if(navegador==0)
	{    
		xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}  
	if(navegador==1)
	{
		xActual=event.clientX+window.scrollX;
		yActual=event.clientY+window.scrollY;
	}
	
	elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
	elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";
	evitaEventos(event);
}

function finMovimiento(event)
{
	if(navegador==0)
	{    
		document.detachEvent("onmousemove", enMovimiento);
		document.detachEvent("onmouseup", finMovimiento);
	}
	if(navegador==1)
	{
		document.removeEventListener("mousemove", enMovimiento, true);
		document.removeEventListener("mouseup", finMovimiento, true); 
	}
}
  </script>
</head>
<body onLoad="carga();">
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">JS Todo List</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            Home <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0" id="filters">
        <label class="font-weight-bold text-info mr-3">Filters</label>
        <input type="radio" name="type" value="all" class="mx-1">
        <label for="male" class="mb-0">All</label>
        <input type="radio" name="type" value="completed" class="mx-1">
        <label for="female" class="mb-0">Completed</label>
        <input type="radio" name="type" value="uncompleted" class="mx-1">
        <label for="other" class="mr-2 mb-0">Uncompleted</label> 

        <input
          class="form-control mr-sm-2"
          type="search"
          name="words"
          placeholder="Words"
          aria-label="Search"
        >
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" id="search">
          Search
        </button>
      </form> -->
    </div>
  </nav>

  <!-- Modal -->
  
  <!-- <div
    class="modal fade"
    id="modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Edit Todo
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger d-none" role="alert" id="modal-alert">
            A simple danger alert—check it out!
          </div>
          <form>
            <div class="form-group">
              <label>Title</label>
              <input
                id="modal-title"
                type="text"
                class="form-control"
                placeholder="Do Something"
              />
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" id="modal-description" rows="3">

              </textarea>
            </div>
            <div class="form-group d-inline-flex">
              <label>Completed</label>
              <div class="mt-1 ml-2">
                <input
                id="modal-completed"
                type="checkbox"
              />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-info" id="modal-btn">
            Save
          </button>
        </div>
      </div>
    </div>
  </div> -->

  <main>
    <div class="container pt-3">
      <div class="alert alert-danger d-none" role="alert" id="alert">
        A simple danger alert—check it out!
      </div>

      <!-- Add Todo -->

      <div>
        <form> 
          <div class="row">
            <div class="col-sm-3 d-sm-flex align-items-center">
              <label class="m-sm-0">Title</label>
              <input
                type="text"
                id="title"
                class="form-control ml-sm-2"
                placeholder="Learn JS"
              >
            </div>
            <div class="px-sm-2 col-sm-7 d-sm-flex align-items-center mt-2 mt-sm-0">
              <label class="m-sm-0">Description</label>
              <input
                type="text"
                id="description"
                class="form-control ml-sm-2"
                placeholder="Watch JS Tutorials"
              >
            </div>
            <div class="col-sm-2 d-sm-flex justify-content-end mt-4 mt-sm-0">
              <button type="button" class="btn btn-info btn-block" id="add">
                Add
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Table -->

      <div class="mt-5">
        <table class="table table-striped" id="table">
          <thead>
            <tr>
              <th scope="col">Todo</th>
              <th scope="col">Description</th>
              <th scope="col">
                <div class="d-flex justify-content-center">
                  Completed
                </div>
              </th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Learn JS
              </td>
              <td>
                Watch Javascript tutorials on Youtube
              </td>
              <td class="text-center">
                <input type="checkbox">
              </td>
              <td class="text-right">
                <button class="btn btn-primary mb-1">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-danger mb-1 ml-1">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <h1>Lista de Actividades</h1>
    <form id="form-tarea">
      <input type="text" id="input-tarea" placeholder="Agregar nueva tarea...">
      <input type="submit" value="Agregar">
    </form>
    <?php
    include "postips.php";

    $cantidad=6;
    $alto=100;
    $izq=100;
    $contador=0;

    for($contador;$contador<$cantidad;$contador++){
      if($contador<3){
        echo $Obj->imprimirPostRojo($alto,$izq,$contador);
      }else{
        echo $Obj->imprimirPostAmar($alto,$izq,$contador);
      }
        
        $alto=$alto+50;
        $izq=$izq+100;
    }
    

?>
    <ul id="lista-tareas">
    </ul>
    <script>
      var listaTareas = document.getElementById("lista-tareas");
      var formTarea = document.getElementById("form-tarea");
      var inputTarea = document.getElementById("input-tarea");

      formTarea.addEventListener("submit", function(event) {
        event.preventDefault();
        agregarTarea();
      });

      function agregarTarea() {
  var tarea = inputTarea.value;
  if (tarea !== "") {
    var li = document.createElement("li");
    var tareaSpan = document.createElement("span");
    tareaSpan.textContent = tarea;
    tareaSpan.addEventListener("click", function() {
      this.parentNode.classList.toggle("completed");
    });

    var completadoCheckbox = document.createElement("input");
    completadoCheckbox.type = "checkbox";
    completadoCheckbox.addEventListener("change", function() {
      if (this.checked) {
        this.parentNode.classList.add("completed");
      } else {
        this.parentNode.classList.remove("completed");
      }
    });

    var fechaInput = document.createElement("input");
    fechaInput.type = "date";

    li.appendChild(completadoCheckbox);
    li.appendChild(tareaSpan);
    li.appendChild(fechaInput);


    listaTareas.appendChild(li);
    inputTarea.value = "";
  }
}
    </script>
    </div>
  </main>

  <!-- JQuery -->
  <script
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
    crossorigin="anonymous"
  ></script>
  <!-- Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- JS Code -->
  <script src="./index.js"></script>
</body>
</html>
