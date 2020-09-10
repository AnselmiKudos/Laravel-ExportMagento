<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{

	protected $nameFile = 'productsV2.csv';

	protected $headings = [];

	protected $index = 0;

	protected $collects = [];

	protected $collectsAux = [];

    public function headings(): array
    {
        return [
			'sku',
			'store_view_code',
			'attribute_set_code',
			'product_type',
			'categories',
			'categories_position',
			'product_websites',
			'cal_tipo',
			'car_capacidad',
			'car_color',
			'car_marcas',
			'car_presentacion',
			'car_tipopapel',
			'cost',
			'country_of_manufacture',
			'created_at',
			'custom_design',
			'custom_design_from',
			'custom_design_to',
			'custom_layout_update',
			'Deal',
			'description',
			'Featured',
			'gallery',
			'gift_message_available',
			'has_options',
			'Hot',
			'hot_date_end',
			'hot_date_start',
			'base_image',
			'base_image_label',
			'insumos_tipo_de_maquina',
			'ins_codigo',
			'ins_marca',
			'ins_modelo',
			'lib_abrochadora_numero',
			'lib_alto',
			'lib_ancho',
			'lib_broches_unidades',
			'lib_capacidad',
			'lib_color',
			'lib_contenido',
			'lib_espesor',
			'lib_formato',
			'lib_graduacion',
			'lib_gramaje',
			'lib_marcas',
			'lib_material',
			'lib_micrones',
			'lib_peso',
			'lib_presentacion',
			'lib_tamano',
			'lib_tipo',
			'lib_trazo',
			'lib_uso',
			'mac_ancho',
			'mac_capacidad',
			'mac_formato',
			'mac_marcas',
			'mac_sillas_sillones',
			'mac_tipo',
			'mac_uso',
			'media_gallery',
			'meta_description',
			'meta_keyword',
			'meta_title',
			'minimal_price',
			'msrp',
			'msrp_display_actual_price_type',
			'msrp_enabled',
			'name',
			'news_from_date',
			'news_to_date',
			'options_container',
			'page_layout',
			'price',
			'required_options',
			'res_color',
			'res_formato',
			'res_gramaje',
			'res_hojas',
			'res_marcas',
			'res_tamano',
			'res_tipo',
			'short_description',
			'show_sdes',
			'small_image',
			'small_image_label',
			'special_from_date',
			'special_price',
			'special_to_date',
			'status',
			'tax_class_name',
			'tec_capacidad',
			'tec_color',
			'tec_marcas',
			'tec_presentacion',
			'tec_pulgadas',
			'tec_tamano',
			'tec_tipo',
			'tec_uso',
			'tec_velocidad',
			'thumbnail_image',
			'thumbnail_image_label',
			'updated_at',
			'url_key',
			'url_path',
			'visibility',
			'weight',
			'qty',
			'min_qty',
			'use_config_min_qty',
			'is_qty_decimal',
			'backorders',
			'use_config_backorders',
			'min_sale_qty',
			'use_config_min_sale_qty',
			'max_sale_qty',
			'use_config_max_sale_qty',
			'is_in_stock',
			'notify_stock_qty',
			'use_config_notify_stock_qty',
			'manage_stock',
			'use_config_manage_stock',
			'stock_status_changed_auto',
			'use_config_qty_increments',
			'qty_increments',
			'use_config_enable_qty_inc',
			'enable_qty_increments',
			'is_decimal_divided',
			'_links_related_sku',
			'_links_related_position',
			'_links_crosssell_sku',
			'_links_crosssell_position',
			'_links_upsell_sku',
			'_links_upsell_position',
			'_associated_sku',
			'_associated_default_qty',
			'_associated_position',
			'_tier_price_website',
			'_tier_price_customer_group',
			'_tier_price_qty',
			'_tier_price_price',
			'_group_price_website',
			'_group_price_customer_group',
			'_group_price_price',
			'_media_attribute_id',
			'additional_images',
			'_media_lable',
			'_media_position',
			'_media_is_disabled',
			'price_type',
			'sku_type',
			'weight_type',
			'price_view',
			'shipment_type'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([$this->get_date()]);
    }

    /**
     * Recorre el CSV
     * @return Array
     */
	public function get_date ()
	{
		$file = public_path($this->nameFile);

		$file_handle = fopen($file, 'r');

		$countRows = 0;

	    $linecount = 0;

	    while (($rows = fgetcsv($file_handle,  30000, ",")) !== FALSE) {
	    	$collect = [];
	    	if ($countRows) {
	    		if ($rows[0]) {

	    			foreach ($rows as $col) {
	    				$collect[] = $col;
	    			}

	    			$collect[1] = $collect[1] ? $collect[1] : 'default';
	    			$collect[2] = $collect[2] ? $collect[2] : 'Default';
	    			$collect[4] = 'Default Category,Default Category/Categorías';
	    			$collect[5] = null;
	    			$collect[6] = 'base';
	    			$collect[24] = 'Use config';
	    			//msrp_display_actual_price_type
	    			$collect[68] = 'Use config';
	    			//msrp_enabled
	    			$collect[69] = 'Use config';
	    			//options_container
	    			$collect[73] = 'Block after Info Column';
	    			//tax_class_name
	    			$collect[92] = 'Taxable Goods';
	    			// Visivility
	    			$collect[107] = 'Catalog, Search';
	    			// url_key
	    			$collect[105] = $this->getUrlPath($collect);
	    			//min_sale_qty
	    			$collect[115] = $collect[115] ? intval($collect[115]) : null;
	    			// weight
	    			$collect[108] = str_replace('.', '', $collect[108]);
	    			$collect[108] = str_replace(',', '.', $collect[108]);
	    			$collect[108] = $collect[108];
	    			// price
	    			$collect[75] = str_replace('.', '', $collect[75]);
	    			$collect[75] = str_replace(',', '', $collect[75]);
	    			$collect[75] = $collect[75];

					$collect[139] = null;
					$collect[140] = null;
					$collect[141] = null;
					$collect[142] = null;
					$collect[143] = 'all';
					
	    			$collect[88] = null;
	    			$collect[89] = null;
	    			$collect[90] = null;

					$this->collectsAux[] = $collect;
					
	    			$this->collects[] = $collect;

	    			$this->index ++;

	    		} else {
	    			$this->manageRow($rows, $countRows);
	    		}
	    	}

	    	$countRows++;
	    }

	    fclose($file_handle);

	    return $this->collects;
	}


	public function getUrlPath ($currentRow)
	{
		foreach ($this->collectsAux as $collect) {
			if ($collect[105] == $currentRow[105]) {
				return str_replace('.html', '', $currentRow[106]);
			}
		}
		return $this->isURlKey($currentRow[105]);
	}

	public function isURlKey ($url) 
	{
		if ($url === 'paraguas-pierre-cardin-corto-hombre-liso') {
			return 'paraguas-pierre-cardin-corto-hombre-liso-'.mt_rand(0, 100);
		}

		if ($url === 'tablero-pizzini-laminado-plastico-40x50-cm') {
			return 'tablero-pizzini-laminado-plastico-40x50-cm-'.mt_rand(0, 100);
		}

		return $url;
	}

	public function manageRow ($currentRow, $countRows)
	{
		$index = $this->index - 1;

		// Categories
		$category = $currentRow[4];
		if ($category) {
	   		$this->collects[$index][4] = $this->collects[$index][4] .',Default Category/Categorías/'. str_replace(',', '-', $category);
	   		// $this->collects[$index][5] = $this->collects[$index][5] .',Default Category/'.$category.'=0';
		}

		// Product_websites
		// $product_websites = $currentRow[6];
		// if ($product_websites) {
	   		// $this->collects[$index][6] = $this->collects[$index][6] .','.$product_websites;
		// }

		// MediaFiles
		$mediaFile = $currentRow[147];
		if ($mediaFile) {
	   		$this->collects[$index][147] = $this->collects[$index][147] .','.$mediaFile;
		}

		// _links_related_sku
		$links_related_sku = $currentRow[130];
		if ($links_related_sku) {
	   		$this->collects[$index][130] = $this->collects[$index][130] ? $this->collects[$index][130] . ','. $links_related_sku : $this->collects[$index][130];
		}

		// _links_upsell_sku
		$links_crosssell_sku = $currentRow[132];
		if ($links_crosssell_sku) { 
	   		$this->collects[$index][132] = $this->collects[$index][132] ? $this->collects[$index][132] . ','. $links_crosssell_sku: $this->collects[$index][132];
	   	}

	   	// :links_upsell_sku
		$links_upsell_sku = $currentRow[134];
		if ($links_upsell_sku) {
	   		$this->collects[$index][134] = $this->collects[$index][134] ? $this->collects[$index][134] . ','. $links_upsell_sku: $this->collects[$index][134];
		}
	}
}
