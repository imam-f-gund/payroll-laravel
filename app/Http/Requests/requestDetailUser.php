<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestDetailUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user_id = $this->request->get('id_user');
    
        return [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan' => 'required',
            'tanggal_masuk' => 'required',
            'id_tambahan' => 'nullable',
            'jabatan_id' => 'required',
            'email' => 'required|unique:users,email,'.$user_id,
        ];
    }
}
