<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body>

@include('includes.loader')

@include('includes.header')

@include('includes.top_bar')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    @include('includes.sidebar')

    @yield('main_content')

</div>
<!-- END MAIN CONTAINER -->

@include('includes.scripts')

</body>

</html>
