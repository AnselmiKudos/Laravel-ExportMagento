<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtributesExport implements FromCollection, WithHeadings
{

	protected $nameFile = 'productsV2.csv';

	protected $index = 0;

	protected $collects = [];

	protected $attributes = [];

	protected $attributeOptions = [];

    public function headings(): array
    {
        return [
        	'store_id',
        	'entity_type',
        	'attribute_set',
        	'group:name',
        	'group:sort_order',
        	'attribute_code',
        	'backend_type',
        	'backend_table',
        	'frontend_model',
        	'frontend_input',
        	'frontend_label',
        	'frontend_class',
        	'source_model',
        	'option:value',
        	'is_required'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->get_date());
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

	    while (($row = fgetcsv($file_handle,  30000, ",")) !== FALSE) {
	    	if ($countRows) {
	    		if ($row[0] && $row[2]) {
					$this->push('cal_tipo', $row[7], $row[2], 'Tipo Calculadora');
					$this->push('car_capacidad', $row[8], $row[2], 'Capacidad');
					$this->push('car_color', $row[9], $row[2], 'Color');
					$this->push('car_marcas', $row[10], $row[2], 'Marca');
					$this->push('car_presentacion', $row[11], $row[2], 'Presentación');
					$this->push('car_tipopapel', $row[12], $row[2], 'Tipo Papel');
	    			// $this->push('Hot', $row[26], $row[2], 'Hot Product', ['frontend_input' => 'boolean']);
	    			// $this->push('hot_date_end', $row[27], $row[2], 'Super oferta hasta', ['frontend_input' => 'date']);
	    			// $this->push('hot_date_start', $row[28], $row[2], 'Super oferta desde', ['frontend_input' => 'date']);
	    			$this->push('insumos_tipo_de_maquina', $row[31], $row[2],'Tipo de Máquina');
	    			$this->push('ins_codigo', $row[32], $row[2], 'Código de Barras', ['frontend_input' => 'text']);
	    			$this->push('ins_marca', $row[33], $row[2], 'Marca');
	    			$this->push('ins_modelo', $row[34], $row[2], 'Modelo');
	    			$this->push('lib_abrochadora_numero', $row[35], $row[2], 'Número');
	    			$this->push('lib_alto', $row[36], $row[2], 'Alto');
	    			$this->push('lib_ancho', $row[37], $row[2], 'Ancho');
	    			$this->push('lib_broches_unidades', $row[38], $row[2], 'Unidades');
	    			$this->push('lib_capacidad', $row[39], $row[2], 'Capacidad');
	    			$this->push('lib_color', $row[40], $row[2], 'Color');
	    			$this->push('lib_contenido', $row[41], $row[2], 'Contenido');
	    			$this->push('lib_espesor', $row[42], $row[2], 'Espesor');
	    			$this->push('lib_formato', $row[43], $row[2], 'Formato');
	    			$this->push('lib_graduacion', $row[44], $row[2], 'Graduación');
	    			$this->push('lib_gramaje', $row[45], $row[2], 'Granaje');
	    			$this->push('lib_marcas', $row[46], $row[2], 'Marcas');
	    			$this->push('lib_material', $row[47], $row[2], 'Material');
	    			$this->push('lib_micrones', $row[48], $row[2], 'Micrones');
	    			$this->push('lib_peso', $row[49], $row[2], 'Peso');
	    			$this->push('lib_presentacion', $row[50], $row[2], 'Presentación');
	    			$this->push('lib_tamano', $row[51], $row[2], 'Tamaño');
	    			$this->push('lib_tipo', $row[52], $row[2], 'Tipo');
	    			$this->push('lib_trazo', $row[53], $row[2], 'Trazo');
	    			$this->push('lib_uso', $row[54], $row[2], 'Uso');
	    			$this->push('mac_ancho', $row[55], $row[2], 'Ancho');
	    			$this->push('mac_capacidad', $row[56], $row[2], 'Capacidad');
	    			$this->push('mac_formato', $row[57], $row[2], 'Formato');
	    			$this->push('mac_marcas', $row[58], $row[2], 'Marcas');
	    			$this->push('mac_sillas_sillones', $row[59], $row[2], 'Tipo');
	    			$this->push('mac_tipo', $row[60], $row[2], 'Tipo');
	    			$this->push('mac_uso', $row[61], $row[2], 'USO');
	    			$this->push('res_color', $row[77], $row[2], 'Color');
	    			$this->push('res_formato', $row[78], $row[2], 'Formato');
	    			$this->push('res_gramaje', $row[78], $row[2], 'Gramaje');
	    			$this->push('res_hojas', $row[80], $row[2], 'Hojas');
	    			$this->push('res_marcas', $row[81], $row[2], 'Marcas');
	    			$this->push('res_tamano', $row[82], $row[2], 'Tamaño');
	    			$this->push('res_tipo', $row[83], $row[2], 'Tipo');
	    			$this->push('tax_class_name', $row[92], $row[2], 'Impuesto');
	    			$this->push('tec_capacidad', $row[93], $row[2], 'Capacidad');
	    			$this->push('tec_color', $row[94], $row[2], 'Color');
	    			$this->push('tec_marcas', $row[95], $row[2], 'Marcas');
	    			$this->push('tec_presentacion', $row[96], $row[2], 'Presentación');
	    			$this->push('tec_pulgadas', $row[97], $row[2], 'Pulgadas');
	    			$this->push('tec_tamano', $row[98], $row[2], 'Tamaño');
	    			$this->push('tec_tipo', $row[99], $row[2], 'Tipo');
	    			$this->push('tec_uso', $row[100], $row[2], 'Uso');
	    			$this->push('tec_velocidad', $row[101], $row[2], 'Valocidad');
	    			$this->index ++;
	    		}
	    	}

	    	$countRows++;
	    }

	    fclose($file_handle);

	    return $this->collects;
	}

	public function push ($name, $value, $attribute_set, $label, $options = []) {
		if ($value) {
			if ($this->isPushOption($attribute_set, $name, $value)) {
		    	$option = [
		    		'0',
		    		null,
		    		$attribute_set,
		    		null,
		    		null,
		    		$name,
		    		null,
		    		null,
		    		null,
		    		null,
		    		null,
		    		null,
		    		null,
		    		$value,
		    		0
		    	];

		    	$this->collects[] = $option;
				$this->attributeOptions[] = $option;
			}
			
			if ($this->isPushAttribute($attribute_set, $name)) {
				$collect = [
		    		'0',
		    		'product',
		    		$attribute_set,
		    		$this->getGroupName($attribute_set),
		    		11,
		    		$name,
		    		null,
		    		null,
		    		null,
		    		array_key_exists('frontend_input', $options) ? $options['frontend_input'] : 'select',
		    		$label,
		    		null,
		    		null,
		    		null,
		    		'0'
		    	];
		    	$this->attributes[] = $collect;
		    	$this->collects[] = $collect;
			}
		}
	}

	public function isPushOption ($attribute_set, $name, $value) {

		foreach ($this->attributeOptions as $option) {
			if ($option[2] == $attribute_set && $option[5] == $name && $option[13] == $value) {
				return false;
			}
		}
		return true;
	}

	public function isPushAttribute ($attribute_set, $name) {
		$band = true;
		foreach ($this->attributes as $collect) {
			if ($collect[2] == $attribute_set && $collect[5] == $name) {
				$band = false;
			}
		}
		return $band;
	}

	public function getGroupName ($attribute_set) {
		switch ($attribute_set) {
			case 'Cartuchos y Tonners':
				return 'Cartuchos y Tonners Opciones';
				break;
			case 'Limpieza e Higiene':
				return 'Limpieza e Higiene Opciones';
				break;
			case 'Librería':
				return 'Librería Opciones';
				break;
			case 'Maquinas de Oficina':
				return 'Máquinas de Oficina Opciones';
				break;
			case 'Muebles y Accesorios':
				return 'Muebles';
				break;
			case 'Resmas':
				return 'Resmas Opciones';
				break;
			case 'Tecnología e Informática':
				return 'Tecnología Opciones';
				break;
			default:
				return 'Product Details';
				break;
		}
	}

}
