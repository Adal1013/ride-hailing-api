<?php

namespace App\Helpers;

use App\Exceptions\WompiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WompiHelper
{
  /**
   */
  public static function request(string $path)
  {
    $requestUrl = static::defineRequestUrl($path);
    $token = static::getKey();
    $response = Http::get($requestUrl . $token);
    return static::getWompiResponseData($response);
  }

  public static function requestWithAuth($path, $requestData, $private=false)
  {
    $requestUrl = static::defineRequestUrl($path);
    $token = static::getKey($private);
    $response = Http::withToken($token)
      ->post($requestUrl, $requestData);
    return static::getWompiResponseData($response);
  }

  /**
   * @throws WompiException
   */
  private static function getWompiResponseData($response): array
  {
    if ($response->failed()) {
      Log::error("Ha ocurrido un error procesando la petición a wompi");
      Log::error($response->json());
      Log::error($response->status());
      throw new WompiException('La petición a Wompi ha fallado.', $response->status());
    }
    return $response->json();
  }

  private static function defineRequestUrl($path): string
  {
    return config('app_config.wompi_url') .  $path;
  }

  private static function getKey($private=false): string
  {
    return $private ? config('app_config.wompi_private_key') : config('app_config.wompi_public_key');
  }
}
