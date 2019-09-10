<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Contracts\ApiResponse;
use Illuminate\Http\Resources\Json\JsonResource;

final class WebsiteResource extends JsonResource implements ApiResponse
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'domain' => $this->domain,
            'single_page' => $this->single_page,
            'tracking_number' => $this->tracking_number,
            'role' => $this->role,
            'permitted_menu' => $this->permitted_menu,
        ];
    }
}
