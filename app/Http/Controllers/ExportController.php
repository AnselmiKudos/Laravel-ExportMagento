<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Exports\CategoriesExport;
use App\Exports\CustomersExport;
use App\Exports\AtributesExport;
use App\Exports\AdvancedPriceExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{    
    protected $collects = [];

    public function index ()
    {
    	return view('export');
    }

    /**
     * Generar archivo para la importacion de de categorias
     * @param  Request $Request
     * @param  string  $type    Tipo del archivo
     * @return Maatwebsite\Excel\Facades\Excel
     */
    public function exportCategories (Request $Request, $type = 'xlsx')
    {
        if ($type == 'csv') {
        	return Excel::download(new CategoriesExport, 'categorias.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    	return Excel::download(new CategoriesExport, 'categorias.xlsx');
    }

    /**
     * Generar archivo para la importacion de de productos
     * @param  Request $Request
     * @param  string  $type    Tipo del archivo
     * @return Maatwebsite\Excel\Facades\Excel
     */
    public function exportProducts (Request $Request, $type = 'xlsx')
    {
        if ($type == 'csv') {
        	return Excel::download(new ProductsExport, 'products.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    	return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * Generar archivo para la importacion de de customers
     * @param  Request $Request
     * @param  string  $type    Tipo del archivo
     * @return Maatwebsite\Excel\Facades\Excel
     */
    public function exportCustomers (Request $Request, $type = 'xlsx')
    {
        if ($type == 'csv') {
        	return Excel::download(new CustomersExport, 'customers.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    public function exportAtributes (Request $Request, $type = 'xlsx')
    {
        if ($type == 'csv') 
            return Excel::download(new AtributesExport, 'atributes.csv', \Maatwebsite\Excel\Excel::CSV);
        
        return Excel::download(new AtributesExport, 'atributes.xlsx');
    }

    public function exportAdvancedPrice (Request $Request, $type = 'xlsx')
    {
        if ($type == 'csv') 
            return Excel::download(new AdvancedPriceExport, 'advanced_price.csv', \Maatwebsite\Excel\Excel::CSV);
        
        return Excel::download(new AdvancedPriceExport, 'advanced_price.xlsx');
    }

}
