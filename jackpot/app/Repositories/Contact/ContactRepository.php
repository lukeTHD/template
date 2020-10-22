<?php

namespace App\Repositories\Contact;

use App\Contact;
use App\Repositories\RepositoriesAbstract;

class ContactRepository extends RepositoriesAbstract implements ContactInterface
{
    public function postContact($data)
    {
        $data['created_at'] = now();
        $contact = new Contact($data);
        $contact->save();
        return $contact;
    }

}
