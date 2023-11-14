<!-- JS Plugins -->
<script src="{{ asset('usr_assets/plugins/jQuery/jquery.min.js') }}"></script>

<script src="{{ asset('usr_assets/plugins/bootstrap/bootstrap.min.js') }}"></script>

<script src="{{ asset('usr_assets/plugins/slick/slick.min.js') }}"></script>

<script src="{{ asset('usr_assets/plugins/instafeed/instafeed.min.js') }}"></script>


<!-- Main Script -->
<script src="{{ asset('usr_assets/js/script.js') }}"></script>
<script>
   $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
      });
  </script>
  {{-- //new add --}}


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      $('.delete').click(function(event) {
          var form = $(this).closest("form");
          event.preventDefault();
          Swal.fire({
              title: 'Do you want to delete this Questions?',
              text: "Once deleted, you will not be able to recover this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it',
              reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  form.submit()
              }
          })
      });
  </script>

<script>
  $('.logout').click(function(event) {
      var form = $(this).closest("form");
      event.preventDefault();
      Swal.fire({
          title: 'Do you want to log out now?',
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              form.submit()
          }
      })
  });
</script>