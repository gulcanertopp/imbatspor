<?php

namespace AppBundle\Data\Repository;


use AppBundle\Data\Model\User;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserRepository extends BaseRepository
{
    public function GetUser()
    {
        try
        {
            $query = "SELECT *  
                      FROM user";

            $result = $this->getConnection()->prepare($query);
            $result->execute();
            $results = $result->fetchAll();

            if ($result === false)
                return false;

            $users = array();

            foreach ($results as &$result)
            {
                $users[] = (new User())->MapFrom($result);
            }

            return $users;

        }catch (Exception $e)
        {
            return false;
        }
    }


    public function LoginUser($userName,$password){

        try{

            $query="SELECT *
                    From user WHERE password = :password AND user_name = :user_name";

            $result = $this->getConnection()->prepare($query);
            $result->execute(array(
                ':user_name'    => $userName,
                ':password'     => $password
            ));
            $result = $result->fetch();

            if ($result === false)
                return false;

            return  (new User())->MapFrom($result);


        }catch (Exception $e){
            return false;
        }

    }




}