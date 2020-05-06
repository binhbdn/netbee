<?php 
namespace App\Services;

use App\Models\SocialAccount;
use JWTAuth;

class SocialAccountService {
   
    protected $socialAccount;
    
    public function __construct(SocialAccount $socialAccount)
    {
        $this->socialAccount = $socialAccount;
    }
    
    public function getProviderByProviderUserId($providerUserId)
    {
        return $this->socialAccount->whereProviderUserId($providerUserId)->orderby('created_at', 'desc')->first();
    }

    public function store($data)
    {
        return $this->socialAccount->insert($data);
    }
} 