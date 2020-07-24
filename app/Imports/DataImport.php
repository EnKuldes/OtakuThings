<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

// Extends 
use \Maatwebsite\Excel\Reader;

# Untuk ambil data request
use Illuminate\Http\Request;
# Untuk koneksi ke DB
use DB;

class DataImport implements ToCollection, WithStartRow, WithChunkReading
{

	private $req;
    private $table_name;
    private $a;
    private $tempArray;
	public function __construct(Request $req) 
    {
        $this->req = $req;
        $this->table_name = 'tm_data_'.strtolower($req->survey);
        $this->a = 1;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $record) {
            if ($this->a != 1) {
                switch ($this->table_name) {
                    case 'tm_data_consumer':
                        $arrayCompareIdx = [($this->req->kolom_npsid-1), ($this->req->kolom_nama_pelanggan-1), ($this->req->kolom_no_hp-1), ($this->req->kolom_nd-1), ($this->req->kolom_nd_reference-1), ($this->req->kolom_episode-1), ($this->req->kolom_treg-1), ($this->req->kolom_witel-1), ($this->req->kolom_produk-1), ($this->req->kolom_ncli-1), ($this->req->kolom_alamat-1)];
                        $namaKolomLainnya = [];
                        for ($i=0; $i < count($record); $i++) { 
                            if (!in_array($i, $arrayCompareIdx)) {
                                $namaKolomLainnya[] = $this->tempArray->values()->get($i).':'.$record->values()->get($i);
                            }
                        }
                        DB::table($this->table_name)->updateOrInsert(
                            [ 
                                'npsid' => $record->values()->get( $this->req->kolom_npsid-1 )
                            ],
                            [
                                'nama_pelanggan' => $record->values()->get($this->req->kolom_nama_pelanggan-1)
                                , 'no_hp' => $record->values()->get($this->req->kolom_no_hp-1)
                                , 'nd' => $record->values()->get($this->req->kolom_nd-1)
                                , 'nd_reference' => $record->values()->get($this->req->kolom_nd_reference-1)
                                , 'episode' => $record->values()->get($this->req->kolom_episode-1)
                                , 'treg' => $record->values()->get($this->req->kolom_treg-1)
                                , 'witel' => $record->values()->get($this->req->kolom_witel-1)
                                , 'produk' => $record->values()->get($this->req->kolom_produk-1)
                                , 'ncli' => $record->values()->get($this->req->kolom_ncli-1)
                                , 'alamat' => $record->values()->get($this->req->kolom_alamat-1)
                                , 'kolom_lainnya' => json_encode($namaKolomLainnya) // count($record) // $this->highestColumn

                            ]
                        );
                        break;
                    case 'tm_data_enterpise':
                        $arrayCompareIdx = [($this->req->kolom_npsid-1 ), ($this->req->kolom_seg-1), ($this->req->kolom_no_hp-1), ($this->req->kolom_business_partner-1), ($this->req->kolom_pic-1), ($this->req->kolom_episode-1), ($this->req->kolom_treg-1), ($this->req->kolom_witel-1), ($this->req->kolom_produk-1), ($this->req->kolom_bp_name-1)];
                        $namaKolomLainnya = [];
                        for ($i=0; $i < count($record); $i++) { 
                            if (!in_array($i, $arrayCompareIdx)) {
                                $namaKolomLainnya[] = $this->tempArray->values()->get($i).':'.$record->values()->get($i);
                            }
                        }
                        DB::table($this->table_name)->updateOrInsert(
                            [
                                'npsid' => $record->values()->get( $this->req->kolom_npsid-1 ) 
                            ],
                            [
                                'seg' => $record->values()->get( $this->req->kolom_seg-1 )
                                , 'no_hp' => $record->values()->get( $this->req->kolom_no_hp-1 )
                                , 'bp' => $record->values()->get( $this->req->kolom_business_partner-1 )
                                , 'pic' => $record->values()->get( $this->req->kolom_pic-1 )
                                , 'episode' => $record->values()->get( $this->req->kolom_episode-1 )
                                , 'treg' => $record->values()->get( $this->req->kolom_treg-1 )
                                , 'witel' => $record->values()->get( $this->req->kolom_witel-1 )
                                , 'produk' => $record->values()->get( $this->req->kolom_produk-1 )
                                , 'bp_name' => $record->values()->get( $this->req->kolom_bp_name-1 )
                                , 'kolom_lainnya' => json_encode($namaKolomLainnya) //count($record) // $this->highestColumn
                            ]
                        );
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
            else{
                $this->a += 1;
                $this->tempArray = $record;
            }
        }
    }

    public function startRow(): int
    {
        return 1;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
