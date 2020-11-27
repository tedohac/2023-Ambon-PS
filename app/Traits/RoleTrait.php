<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Perusahaan;
use App\Univ;
use Auth;

trait RoleTrait {
    /**

     * @param Request $request

     * @return $this|false|string

     */

    public function redirectRole()
    {
        if(Auth::user()->user_status == 1) return redirect()->route('verifyneeded');
        elseif(Auth::user()->user_role == 'admin kampus')
        {
            $univ = Univ::where('univ_user_email', Auth::user()->user_email )->first();
            return redirect('kampus/detail/'.$univ->univ_id);
        }
        elseif(Auth::user()->user_role == 'dospem')
        {
            return redirect()->route('kampus.list');
        }
        elseif(Auth::user()->user_role == 'mahasiswa')
        {
            $mahasiswa = Mahasiswa::where('mahasiswa_user_email', Auth::user()->user_email )->first();
            return redirect('mahasiswa/detail/'.$mahasiswa->mahasiswa_id);
        }
        elseif(Auth::user()->user_role == 'perusahaan')
        {
            $perusahaan = Perusahaan::where('perusahaan_user_email', Auth::user()->user_email )->first();
            return redirect('perusahaan/detail/'.$perusahaan->perusahaan_id);
        }
        echo Auth::user()->role."asd";
        // abort(404);
    }
}

  