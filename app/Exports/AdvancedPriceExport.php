<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdvancedPriceExport implements FromCollection, WithHeadings
{

	protected $nameFile = 'productsV2.csv';

	protected $collects = [];

	protected $currentProduct = null;

    public function headings(): array
    {
        return [
			'sku',
			'tier_price_website',
			'tier_price_customer_group',
			'tier_price_qty',
			'tier_price',
			'tier_price_value_type'
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

	    while (($collect = fgetcsv($file_handle,  30000, ",")) !== FALSE) {
	    	if ($countRows) {
	    		if ($collect[0]) {
	    			$this->currentProduct = $collect[0];
	    		}
	    		
	    		if ($collect[145]) {
    				$this->collects[] = [
						// sku
						$this->currentProduct,
						// tier_price_website
						'All Websites [ARS]',
						// tier_price_customer_group
						$this->getCustomerGroup($collect[144]),
						// tier_price_qty
						1,
						// tier_price
						$this->getPrice($collect[145]),
						// tier_price_value_type
						'Fixed'
	    			];
	    		}
	    	}

	    	$countRows++;
	    }

	    fclose($file_handle);

	    return $this->collects;
	}

	public function getPrice ($price)
	{
		$price = str_replace('.', '', $price);

		return str_replace(',', '.', $price);
	}

	public function getCustomerGroup ($group)
	{
		switch ($group) {
			case 3:
				return 'Empresas A';
				break;
			case 6:
				return 'Empresas B';
				break;
			case 7:
				return 'Empresas C';
				break;
		}
	}
}
