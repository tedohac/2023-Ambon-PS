<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Dospem;

class NikDospemRule implements Rule
{
    public $univ_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($univ_id)
    {
        $this->univ_id = $univ_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $dospem = Dospem::join('prodis', 'prodis.prodi_id', '=', 'dospems.dospem_prodi_id')
                        ->where('prodis.prodi_univ_id', $this->univ_id)
                        ->where('dospems.dospem_nik', $value)
                        ->get();
        
        return $dospem->count()===0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'NIK dosen pembimbing sudah terdaftar pada kampus anda.';
    }
}
