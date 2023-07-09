<?php 

    //  $urlSameBox = "https://sandbox.asaas.com/";

    //  $urlProduction = "https://www.asaas.com/";



    // $crl = curl_init($urlSameBox . '/api/v3/customers');

    // $header = array();
    // $header[] = 'Authorization: Value=Token token=$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAzMjM0NDE6OiRhYWNoXzk2NDQxNTU3LTQzNDAtNGUzYS1hOTU0LTM1ZjZiODEwMzhlNQ==';

    // curl_setopt($crl, CURLOPT_HTTPHEADER,$header);
    // $rest = curl_exec($crl);

    // curl_close($crl);

    // print_r($rest);


    /*
 * Github: @luizhpereira
 * Autor: Luiz Henrique Pereira
 * Contato: luizpereiragit@gmail.com
 * 
 * Autocheck para atualização de status e integração/comunicação com API de pagamento https://www.asaas.com
 * Documentação: https://asaasv3.docs.apiary.io
 */
// session_start();

//exemplo de consulta dos status salvos no banco de dados.
// $arrObjPagamento = ControladorAfiliado_Pagamento::listarPorSituacao("PENDING");


// if ($arrObjPagamento) {
    //laço 
    // foreach($arrObjPagamento as $retorno)
    // {
        //código do cliente que é servido pela API Asaas e deve ser armazenado no banco de dados.
        // $customer = $retorno->getCodigo();

    /*public stactic function (){
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://www.asaas.com/api/v3/myAccount/commercialInfo");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'access_token: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAzMjM0NDE6OiRhYWNoXzk2NDQxNTU3LTQzNDAtNGUzYS1hOTU0LTM1ZjZiODEwMzhlNQ=='
        ));
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        // $response = json_decode($response);

        print_r($response);
        
    }
      */
    // }
// }


namespace integrationAsaasNameSpace{

    include('connect.php');

    class integrationAsaas {

        public static $urlSameBox = "https://sandbox.asaas.com/";


        public static function cadastrarCliente($nome, $cpfcnpj) {

            print_r('Função cadastrar cliente iniciada');

            print_r($nome . ' ' . $cpfcnpj);

            $urlProduction = "https://www.asaas.com/";


            $postData = http_build_query(
                array(
                    'name' => $nome,
                    'cpfCnpj' => $cpfcnpj

                    
                ));

            

            $ch = curl_init();        
            curl_setopt($ch, CURLOPT_URL, $urlProduction."/api/v3/customers");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);


            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'access_token: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAzMjM0NDE6OiRhYWNoXzk2NDQxNTU3LTQzNDAtNGUzYS1hOTU0LTM1ZjZiODEwMzhlNQ=='
            ));
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($response);

             print_r($response->errors[0]->description);



            if($response->errors[0]->description != 'O CPF ou CNPJ informado é inválido.'){

                include('connect.php');

                $sql_code = "UPDATE usuario SET custumer_id='{$response->id}' WHERE cpfcnpj=".$cpfcnpj;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                

            }

            else{

                print_r('<br>O CPF ou CNPJ informado é inválido.');

            }


            
		

            print_r($response->id);                

                //return "Hello from my static function!";             

        }

        public static function verificarUser($nome, $cpfcnpj) {



             include('connect.php');


            $sql_code = "SELECT * FROM usuario WHERE cpfcnpj=".$cpfcnpj;

		    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            $user = $sql_query->fetch_object();

            // return $user->custumer_id;

            if($user->custumer_id != null){

                // cadastrarCliente($nome, $cpfcnpj);
        
                print_r($user->custumer_id);
        
        
            }
        
            else{

                print 'Else Iniciado';

                integrationAsaas::cadastrarCliente($nome, $cpfcnpj);
        
                print_r('Usuário Cadastrado com Sucesso!');
        
        
            }
           
        }

        public static function createPayment($custumer_id){

            
            print_r('Função realizar pagamento iniciada');


            $urlProduction = "https://www.asaas.com/";


            $postData = http_build_query(
                
                array(
                    'customer' => $custumer_id,
                    'billingType' => 'BOLETO',
                    "dueDate"=> "2023-07-10",
                    "value"=> 150,
                    "description"=> "Pedido 056984",
                    "externalReference"=> "056984",
                    "discount"=> array(
                        "value"=> 0,
                        "dueDateLimitDays"=> 0
                    ),
                      "fine"=> array(
                        "value"=> 1
                      ),
                      "interest"=> array(
                        "value"=> 2
                      ),
                      "postalService"=> false
                ));


            $ch = curl_init();        
            curl_setopt($ch, CURLOPT_URL, $urlProduction."/api/v3/payments");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);


            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'access_token: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAzMjM0NDE6OiRhYWNoXzk2NDQxNTU3LTQzNDAtNGUzYS1hOTU0LTM1ZjZiODEwMzhlNQ=='
            ));
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($response);

            print_r($response);



            header("Location: " . $response->bankSlipUrl);


            //  print_r($response->errors[0]->description);

/*

            if($response->errors[0]->description != 'O CPF ou CNPJ informado é inválido.'){

                include('connect.php');

                $sql_code = "UPDATE usuario SET custumer_id='{$response->id}' WHERE cpfcnpj=".$cpfcnpj;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                

            }

            else{

                print_r('<br>O CPF ou CNPJ informado é inválido.');

            }
*/

            
		

            print_r($response->id);                

                //return "Hello from my static function!";          

        }

    }

}


// namespace integrationAsaasNameSpace {
//     class MyClass {
//         public static function myStaticFunction() {
//             return "Hello from my static function!";
//         }
//     }
// }


/*$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAzMjM0NDE6OiRhYWNoXzk2NDQxNTU3LTQzNDAtNGUzYS1hOTU0LTM1ZjZiODEwMzhlNQ== */

?>