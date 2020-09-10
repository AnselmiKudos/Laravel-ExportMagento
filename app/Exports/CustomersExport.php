<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
	protected $nameFile = 'customer.csv';

	protected $collects = [];

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
	    		$collect[1] = 'base';
	    		// store
	    		$collect[2] = 'default';
	    		// group_id
	    		$collect[15] = $this->getGroupId($collect[15]);
	    		// store_id
	    		$collect[31] = '1';
	    		// website_id
	    		$collect[35] = '1';
	    		// unset($collect[3]);
	    		// unset($collect[4]);
	    		unset($collect[8]);
	    		// unset($collect[10]);
	    		unset($collect[12]);
	    		unset($collect[16]);
	    		unset($collect[17]);
	    		unset($collect[18]);
	    		unset($collect[19]);
	    		unset($collect[20]);
	    		unset($collect[21]);
	    		unset($collect[24]);
	    		unset($collect[27]);
	    		unset($collect[30]);
	    		unset($collect[34]);
	    		unset($collect[35]);
	    		// $collect[38] = $collect[38] ? $collect[38] : 'NULL';
	    		// $collect[40] = $collect[40] ? $collect[40] : 'AR';
	    		if ($collect[0] && $collect[38] ) {
					$this->collects[] = $collect;
	    		}
	    	}
	    	$countRows++;
	    }

	    fclose($file_handle);

	    return $this->collects;
	}

	//	3 Retailer
	//	4 Empresas
	//	5 Empresas A
	//	6 Empresas B
	//	7 Empresas C

	// 3	Empresas A	Cliente Empresas
	// 6	Empresas B	Cliente Empresas
	// 7	Empresas C	Cliente Empresas
	// 1	General	Cliente Retail
	// 0	NOT LOGGED IN	Cliente Retail
	// 2	Wholesale	Cliente Retail
    public function getGroupId ($group_id)
    {
    	switch ($group_id) {
    		case 1:
    			// General
    			return 3;
    			break;
    		case 6:
    			// Empresa B
    			return 6;
    			break;
    		case 3:
    			// Empresa C
    			return 5;
    			break;
    		case 7:
    			// Empresa C
    			return 7;
    			break;
    		default:
    			return $group_id;
    			break;
    	}
    }

    public function headings(): array
    {
        return [
			'email',
			'_website',
			'_store',
			'barrio',
			'condicion_iva',
			'confirmation',
			'created_at',
			'created_in',
			'disable_auto_group_change',
			'dni_retail',
			'dob',
			'firstname',
			'gender',
			'group_id',
			'lastname',
			'middlename',
			'password_hash',
			'prefix',
			'rp_token',
			'rp_token_created_at',
			'store_id',
			'suffix',
			'taxvat',
			'website_id',
			'password',
			'_address_city',
			'_address_company',
			'_address_country_id',
			'_address_fax',
			'_address_firstname',
			'_address_lastname',
			'_address_postcode',
			'_address_prefix',
			'_address_region',
			'_address_street',
			'_address_suffix',
			'_address_telephone',
			'_address_vat_id',
			'_address_default_billing_',
			'_address_default_shipping_'
        ];
    }
}
