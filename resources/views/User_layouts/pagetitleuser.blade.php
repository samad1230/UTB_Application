<div class="breadcrumb">
    <?php
    $clickmenu = Request::path();
    $para = explode("/",$clickmenu);
    ?>
    <h1> {{$para[0]}}</h1>
    <ul>
        <li><a href="">{{@$para[1]}}</a></li>
        <li>{{@$para[2]}}</li>
{{--        <li>{{@$para[3]}}</li>--}}
    </ul>

</div>
