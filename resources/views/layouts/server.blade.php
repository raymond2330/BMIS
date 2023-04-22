<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body class="bg-light">
    <header>
        @include('includes.header-server')
        @include('includes.breadcrumb')
    </header>
    <div id="main" style="min-height:100vh">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(Route::current()->getName() != 'admin')
                    @include('includes.side-navigation')
                    @endif
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
    <footer>
        @include('includes.footer')
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/kogos4e3i28a6tb2dnuq31kw6wnycc1tc6pbredig4ew514h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var mybutton = document.getElementById("toTop");
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        tinymce.init({
            selector: '#announcement',
            plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker advimage',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table numlist bullist',
            toolbar_mode: 'floating',
        });
    </script>
</body>

</html>