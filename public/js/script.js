
			/*var Gato= new gato("garfield");

			function gato (nombre) {
				this.nombre=nombre;
				this.maullar=function (){
					alert("miaaaw");
				};
			}*/

			$(document).on('ready',function(){
				var seleccion=$(".ejem1");
				if(seleccion.length)
					console.log("Existen: "+seleccion.length);
				else
					console.log("No existe");

				$("#parrafo1,#parrafo2,span").text("ey! somosssss iguales!");
				if(seleccion.not(".cl1"))
				$("#desaparecera").hide("slow");
				
				seleccion.has("p").text("Este elemento tiene paragraph en ejem1");
				$("li").first().html("<strong>Soy el elemento 1</strong>");
				$("li").eq(1).html("<strong>Soy el elemento 2</strong>");
			});
		
			
