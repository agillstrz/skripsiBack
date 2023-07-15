<?php

namespace App\Http\Resources;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $siswa = Siswa::where('id', $this->id)->select(['id','nim', 'kelas_id'])->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'siswa' => $siswa,
            'kelas' => $siswa->kelas_id
        ];
    }
}