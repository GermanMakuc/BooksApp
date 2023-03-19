(function ($) {
	"use strict";
  
		$(window).on('load', function () {

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false
      })

      var rootCards = $("#bookCards");
      $('.originalCard:first').hide();

      $.ajax({
        type: 'get',
        url: 'https://www.googleapis.com/books/v1/volumes?q=Harry+Potter',
        dataType: 'json',

        beforeSend: function() {
           $(".loading").append('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
        },
        success: function(data) {
         
          data.items.forEach(element => {
              var cards = $(".originalCard:first").clone();
              var newHref = $(cards).find('a').attr("href") +"book.php?id="+ element['id'];
              $(cards).find('a').attr("href", newHref);
              $(cards).find('.card').attr('id', element['id']);
              $(cards).find('.card-title').html(element['volumeInfo'].title);
              if(element['volumeInfo']['imageLinks'] == null || element['volumeInfo']['imageLinks'] === 'undifined')
                $(cards).find('img').attr("src", "https://placehold.co/152x178?text=No%20Image");
              else
                $(cards).find('img').attr("src", element['volumeInfo']['imageLinks'].thumbnail);
              
              $(cards).find('.text-muted').append(element['volumeInfo'].contentVersion);
              $(cards).show();
              $(cards).appendTo(rootCards);
            });


        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        },
        complete: function() {
          $(".spinner-border").remove();
        }
      }); // end ajax

      $( "#addComment" ).click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        let id = $(".card").attr("data-id");
        let comments = $("#commentValue").val();
        let btnSaved = $("#addComment");

        if(comments == '')
        {
          Toast.fire({
            icon: 'error',
            title: 'El campo no debe estar vacío',
            timer: 3000,
            timerProgressBar: true
          });
        }
        else
        {
          $.ajax({

            url: 'api/comments.php',
            type: 'post',
            data: {
              id : id,
              comments : comments
            },
  
            beforeSend: function() {
              btnSaved.attr("disabled", true);
            },
            success: function(data) {
              if(data.state)
              {
                Toast.fire({
                  icon: 'success',
                  title: 'Ha comentado el libro',
                  timer: 3000,
                  timerProgressBar: true
                }).then((result) => {
                  // Reload the Page
                  location.reload();
                });
              }
              else
              {
                Toast.fire({
                  icon: 'success',
                  title: 'Ha actualizado su comentario',
                  timer: 3000,
                  timerProgressBar: true
                }).then((result) => {
                  // Reload the Page
                  location.reload();
              });
  
              }
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function() {
              btnSaved.attr("disabled", false);
            }
          }); // end ajax
        }
        

      });
      

      $( "#savedAction" ).click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        let id = $(".card").attr("data-id");
        let image = $(".card").attr("data-image");
        let title = $(".card").attr("data-title");
        let description = $(".card").attr("data-description");
        let version = $(".card").attr("data-version");
        let btnSaved = $("#savedAction");
        
        $.ajax({

          url: 'api/favorites.php',
          type: 'post',
          data: {
            id : id,
            image : image,
            title : title,
            description : description,
            version : version
          },

          beforeSend: function() {
            btnSaved.text('');
          },
          success: function(data) {
            if(data.state)
            {
              Toast.fire({
                icon: 'success',
                title: 'Ha sido agregado a tus guardados',
                timer: 3000,
                timerProgressBar: true
              });

              btnSaved.text('Borrar de mis Guardados');
            }
            else
            {
              Toast.fire({
                icon: 'error',
                title: 'Ha sido borrado de tus guardados',
                timer: 3000,
                timerProgressBar: true
              });

              btnSaved.text('Agregar a mis Guardados');
            }
          },
          error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              console.log(err.Message);
          },
          complete: function() {
              
          }
        }); // end ajax

      });

      $( "#searchButton" ).click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        var $this = $(this);
        let value = $("#searchValue").val();
        var rootCards = $("#bookCards");

        if(value == '')
        {
          Toast.fire({
            icon: 'error',
            title: 'El campo no debe estar vacío',
            timer: 3000,
            timerProgressBar: true
          });
        }
        else
        {
          $.ajax({
            type: 'get',
            url: 'https://www.googleapis.com/books/v1/volumes?q='+value,
            dataType: 'json',

            beforeSend: function() {
                $(".loading").append('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                $this.attr("disabled", true);
                $('.col').hide();
            },
            success: function(data) {
              data.items.forEach(element => {
                var cards = $(".originalCard:first").clone();
                var newHref = $(cards).find('a').attr("href") +"book.php?id="+ element['id'];
                $(cards).find('a').attr("href", newHref);
                $(cards).find('.card').attr('id', element['id']);
                $(cards).find('.card-title').html(element['volumeInfo'].title);
                if(element['volumeInfo']['imageLinks'] == null || element['volumeInfo']['imageLinks'] === 'undifined')
                  $(cards).find('img').attr("src", "https://placehold.co/152x178?text=No%20Image");
                else
                  $(cards).find('img').attr("src", element['volumeInfo']['imageLinks'].thumbnail);
                
                $(cards).find('.text-muted').append(element['volumeInfo'].contentVersion);
                $(cards).show();
                $(cards).appendTo(rootCards);
              });
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function() {
              $(".spinner-border").remove();
              $this.attr("disabled", false);
            }
          }); // end ajax
        }

      });

	})
	
})(window.jQuery); // JavaScript Document
