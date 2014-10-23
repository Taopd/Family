<?php

class JsonComponent extends Component {

    public function getDecodedFromPostdata() {
        $jsonInput = file_get_contents('php://input');
        $decoded = json_decode($jsonInput,true);
        return $decoded;
    }

}
