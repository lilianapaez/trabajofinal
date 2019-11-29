<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\models\Usuario;
use app\models\Rol;


class Permiso 
{
    
    public static function findIdentity($id) {
        return Usuario::findOne($id);
    }

    public static function findByUsername($dni) {
        return Usuario::findOne(["dni" => $dni]);
    }

    public function requerirRol($descripcionRol){

        if(!Yii::$app->user->identity==null){
            $descRol=Yii::$app->user->identity->rol->descripcionrol;

            return $descRol==$descripcionRol?true:false;
        }

    }
    public function requerirActivo($activado){

        $activo=Usuario::findIdentity($_SESSION['__id']);
        return $activo->activado==$activado?true:false;
        //Yii::$app->user->identity->activado->activado;
        //return $activo==$activado?true:false;
    }


}


