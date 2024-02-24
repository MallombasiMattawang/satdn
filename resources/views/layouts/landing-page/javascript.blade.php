<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/landing-page/js/scripts.js') }}"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script>
    $(document).ready(function($) {
        $('.list-search li').each(function() {
            $(this).attr('searchData', $(this).text().toLowerCase());
        });
        $('.form-search').on('keyup', function() {
            var dataList = $(this).val().toLowerCase();
            $('.list-search li').each(function() {
                if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList
                    .length < 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {

        $('.layanan-info').click(function() {

            var serviceId = $(this).data('id');
            $(".spinner").show();

            // AJAX request
            $.ajax({
                url: 'service-page',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    serviceId: serviceId
                },
                success: function(response) {
                    $(".spinner").show();
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#empModal').modal('show');
                    $(".spinner").hide();
                }
            });
        });
    });
</script>
