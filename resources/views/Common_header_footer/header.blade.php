<!DOCTYPE html>
<html lang="en" dir="">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ "UTB Application"}}</title>
	<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{asset('Admin_asset/dist-assets/css/themes/lite-purple.min.css')}}" rel="stylesheet" />
    <link href="{{asset('Admin_asset/dist-assets/css/plugins/perfect-scrollbar.min.css')}}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('Admin_asset/dist-assets/css/plugins/datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('Admin_asset/image_upload/css/image-uploader.min.css')}}">

    <link rel="stylesheet" href="{{ asset('Admin_asset/toastr.css') }}">
    <link href="{{asset('Admin_asset/style.css')}}" rel="stylesheet" />
</head>
