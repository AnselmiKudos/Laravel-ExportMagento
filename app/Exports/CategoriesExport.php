<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    
	protected $nameFile = 'categorias.csv';

	protected $collects = [];

    public function headings(): array
    {
        return [
			'name',
			'store_view',
			'store_name',
			'image',
			'url_path',
			'available_sort_by',
			'category_is_link',
			'custom_apply_to_products',
			'custom_design',
			'custom_design_from',
			'custom_design_to',
			'custom_layout_update',
			'custom_use_parent_settings',
			'default_sort_by',
			'description',
			'disabled_children',
			'display_mode',
			'filter_price_range',
			'include_in_menu',
			'is_active',
			'is_anchor',
			'label_value',
			'landing_page',
			'level_column_count',
			'meta_description',
			'meta_keywords',
			'meta_title',
			'nbr_product_value',
			'page_layout',
			// 'path',
			// 'path_in_store',
			// 'position',
			'show_products',
			'static_block_bottom_value',
			'static_block_left_value',
			'static_block_right_value',
			'static_block_top_value',
			'url_key',
			'use_label',
			'use_static_block',
			'use_static_block_bottom',
			'use_static_block_left',
			'use_static_block_right',
			'use_static_block_top',
			'use_thumbail'
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

		$this->collects[] = [
			'Default Category/Categorías',
			'default',
			null,
			null,
			'categories',
			null,
			'Yes',
			'No',
			null,
			null,
			null,
			null,
			'No',
			null,
			null,
			'No',
			'Products only',
			Null,
			'Yes',
			'Yes',
			'Yes',
			null,
			null,
			'1 column',
			null,
			null,
			null,
			null,
			null,
			// 'path',
			// 'path_in_store',
			// 'position',
			null,
			null,
			null,
			null,
			null,
			'categories',
			'Yes',
			'Yes',
			'Yes',
			'Yes',
			'Yes',
			'Yes',
			null
		];
		$countRows = 0;

	    while (($rows = fgetcsv($file_handle,  30000, ",")) !== FALSE) {
	    	$collect = [];
	    	if ($countRows) {
		    	$rows[0] = str_replace(',', '-', $rows[0]);
	    		if ($rows[0] && $this->isCategory('Default Category/Categorías/'.$rows[0])) {
					$this->collects[] = [
						'Default Category/Categorías/'.$rows[0],
						'default',
							null,
							null,
							str_replace('--', '-', $this->desaccent($rows[0])),
							null,
						'Yes',
						'No',
							null,
							null,
							null,
							null,
						'No',
							null,
							null,
						'No',
						'Products only',
							Null,
						'Yes',
						'Yes',
						'Yes',
							null,
							null,
						'1 column',
							null,
							null,
							null,
							null,
							null,
						// 'path',
						// 'path_in_store',
						// 'position',
							null,
							null,
							null,
							null,
							null,
							str_replace('--', '-', $this->desaccent($rows[0])),
						'Yes',
						'Yes',
						'Yes',
						'Yes',
						'Yes',
						'Yes',
						 null
					];
	    		}
    		}
    		
    		$countRows++;
	    }

	    fclose($file_handle);

	    return $this->collects;
	}

	public function desaccent ($s_str) {
		$a_char = array ('?', '¿','!', '*', '&', '@', '#',
		'-', '(', ')', '[',']', '{','}');
		$s_str = str_replace($a_char,"", strtolower($s_str));
		return strtr(utf8_decode($s_str),
		" \xe1\xc1\xe0\xc0\xe2\xc2\xe4\xc4\xe3\xc3\xe5\xc5".
		"\xaa\xe7\xc7\xe9\xc9\xe8\xc8\xea\xca\xeb\xcb\xed".
		"\xcd\xec\xcc\xee\xce\xef\xcf\xf1\xd1\xf3\xd3\xf2".
		"\xd2\xf4\xd4\xf6\xd6\xf5\xd5\x8\xd8\xba\xf0\xfa\xda".
		"\xf9\xd9\xfb\xdb\xfc\xdc\xfd\xdd\xff\xe6\xc6\xdf\xf8",
		"-aAaAaAaAaAaAacCeEeEeEeEiIiIiIiInNoOoOoOoOoOoOoouUuUuUuUyYyaAso—");
	}

	public function isCategory ($currentCategory)
	{
		foreach ($this->collects as $collect) {
			if ($collect[0] == $currentCategory) {
				return false;
			}
		}
		return true;
	}
}
