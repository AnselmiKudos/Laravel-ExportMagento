@extends('layout.master')

@section('content')
    <div class="title m-b-md">
        EXPORTACIÓN A MG2
    </div>

    <div class="links">
        <div style="display: inline-block;">
            CATEGORÍAS
            <div class="links">
                <a href="{{ route('export.categories') }}" target="_blank">XLSX</a>
                <a href="{{ route('export.categories', ['type' => 'csv']) }}" target="_blank">CSV</a>
            </div>
        </div>
        <div style="display: inline-block;">
            PRODUCTOS
            <div class="links">
                <a href="{{ route('export.products') }}" target="_blank">XLSX</a>
                <a href="{{ route('export.products', ['type' => 'csv']) }}" target="_blank">CSV</a>
            </div>
        </div>
        <div style="display: inline-block;">
            ADVANCED PRICE
            <div class="links">
                <a href="{{ route('export.advanced-price') }}" target="_blank">XLSX</a>
                <a href="{{ route('export.advanced-price', ['type' => 'csv']) }}" target="_blank">CSV</a>
            </div>
        </div>
        <div style="display: inline-block;">
            CLIENTES
            <div class="links">
                <a href="{{ route('export.customers') }}" target="_blank">XLSX</a>
                <a href="{{ route('export.customers', ['type' => 'csv']) }}" target="_blank">CSV</a>
            </div>
        </div>
        <div style="display: inline-block;">
            ATRIBUTOS   
            <div class="links">
                <a href="{{ route('export.atributes') }}" target="_blank">XLSX</a>
                <a href="{{ route('export.atributes', ['type' => 'csv']) }}" target="_blank">CSV</a>
            </div>
        </div>
    </div>
@endsection