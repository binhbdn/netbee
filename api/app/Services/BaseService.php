<?php
namespace App\Services;

class BaseService {
    const
        ACTIVE = 1,
        INACTIVE = 0;
    const
        ROLE_ADMIN = 4,
        ROLE_HR = 3,
        ROLE_COMPANY = 2,
        ROLE_STAFF = 1;

    const
        BLOCK = 1,
        UN_BLOCK = 0;

    const
        DELETE = 1,
        UN_DELETE = 0;

    const
        FACEBOOK = 'facebook',
        GOOGLE = 'google';

    const
        JOB_LABOR_EXPORT = 1,
        JOB_OVERSEAS_STUDENT = 2,
        JOB_TRAINEES = 3;

    const
        NEW_VIP = 2,
        NEW_HOT = 1;

    const
        DEFAULT = 'default',
        BANK = 'bank';
}
