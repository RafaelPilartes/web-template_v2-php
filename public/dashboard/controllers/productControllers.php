<?php
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_product') {
  $num_register = $_GET['numRegister'];

  $result_product = $pdo->prepare("SELECT * FROM product ORDER BY id DESC LIMIT :limitRegister");
  $result_product->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_product->execute();
  $num_product = $result_product->rowCount();

  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum produto cadastrada </div>";
  } else {
    $return = "";

    while ($row_product = $result_product->fetch(PDO::FETCH_ASSOC)) {

      extract($row_product);

      $decode_images_product = json_decode($images_product);

      $url_image = "";

      if ($decode_images_product) {
        $url_image = $decode_images_product[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
      }

      $state_is = '';
      if ($stock_product == 'In Stock') {
        $state_is = 'completed';
      } else {
        $state_is = 'pending';
      }

      $numberFormattedOld = '';
      $renderNumberFormattedOld = '----------';
      $numberFormattedNew = number_format($new_price_product, 2, ',', '.');
      if (!empty($old_price_product)) {
        $numberFormattedOld = number_format($old_price_product, 2, ',', '.');
        $renderNumberFormattedOld = "$numberFormattedOld Akz";
      }

      $return .= "
        <tr>
          <td>
            <p>$id</p>
          </td>
          <td>
            <img src='$url_image' />
          </td>
          <td>
            <p>$name_product</p>
          </td>
          <td>
            <p>$category_product</p>
          </td>
          <td>
            <p>$renderNumberFormattedOld</p>
          </td>
          <td>
            <p>$numberFormattedNew Akz</p>
          </td>
          <td>
            <div class='status $state_is'>$stock_product</div>
          </td>
          <td>
            <p>$date_create</p>
          </td>
          <td>
            $views_product
          </td>
          <td class='row'>
            <button onclick='deleteProduct($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
            <button onclick='editeProduct($id)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='seeProduct($id)' class='btn-see'>
              <i class='fas fa-eye'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}
if ($type_form == 'get_all_product_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM product WHERE name_product LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_product = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_product);


        $decode_images_product = json_decode($images_product);

        $url_image = "";

        if ($decode_images_product) {
          $url_image = $decode_images_product[0];
        } else {
          $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
        }

        $numberFormattedOld = number_format($old_price_product, 2, ',', '.');
        $numberFormattedNew = number_format($new_price_product, 2, ',', '.');

        $state_is = '';

        if ($stock_product == 'In Stock') {
          $state_is = 'completed';
        } else {
          $state_is = 'pending';
        }

        $dataRegister .= "
          <tr>
            <td>
              <p>$id</p>
            </td>
            <td>
              <img src='$url_image' />
            </td>
            <td>
              <p>$name_product</p>
            </td>
            <td>
              <p>$category_product</p>
            </td>
            <td>
              <p>$numberFormattedOld Akz</p>
            </td>
            <td>
              <p>$numberFormattedNew Akz</p>
            </td>
            <td>
              <div class='status $state_is'>$stock_product</div>
            </td>
            <td>
              <p>$date_create</p>
            </td>
            <td>
              $views_product
            </td>
            <td class='row'>
              <button onclick='deleteProduct($id)' class='btn-delete'>
                <i class='fas fa-trash-alt'></i>
              </button>
              <button onclick='editeProduct($id)' class='btn-edit'>
                <i class='fas fa-edit'></i>
              </button>
              <button onclick='seeProduct($id)' class='btn-see'>
                <i class='fas fa-eye'></i>
              </button>
            </td>
          </tr>
        ";
      }

      $return = ['error' => false, 'msg' => $dataRegister];
    }
  }

  echo json_encode($return);
}

if ($type_form == 'get_all_characteristics') {
  $id_product = $_GET['idProduct'];

  $result_characteristic = $pdo->prepare("SELECT * FROM characteristics WHERE id_product=?");
  $result_characteristic->execute(array($id_product));
  $num_characteristic = $result_characteristic->rowCount();


  if ($num_characteristic <= 0) {
    $return = ['error' => true, 'msg' => "Este produto não tem nenhuma caracteristica"];

    echo json_encode($return);
  } else {
    $return = $result_characteristic->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($return);
  }
}
if ($type_form == 'delete_characteristic') {
  $id_characteristic = $_GET['idCharacteristic'];

  $result_product = $pdo->prepare("DELETE FROM characteristics WHERE id=?");

  if ($result_product->execute(array($id_characteristic))) {
    $return = ['error' => false, 'msg' => "A caracteristica foi excluído :)"];
  } else {
    $return = ['error' => true, 'msg' =>  "Ouve algum erro ao excluir a caracteristica"];
  }

  echo json_encode($return);
}

if ($type_form == 'create_product') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";

  $images_product_form = $_FILES['images_product'];
  $images_array_product_form = [];

  $name_product_form = $dataForm['name_product'];
  $description_product_form = $dataForm['description_product'];
  $old_price_product_form = $dataForm['old_price_product'];
  $new_price_product_form = $dataForm['new_price_product'];
  $category_product_form = $dataForm['category_product'];
  $stock_product_form = $dataForm['stock_product'];

  $product_store_form = $dataForm['product_store'];
  $link_product_form = '';
  if (isset($dataForm['link_product'])) {
    $link_product_form = $dataForm['link_product'];
  }
  $is_best_sellers_form = $dataForm['is_best_sellers'];
  $is_new_arrivals_form = $dataForm['is_new_arrivals'];
  $is_top_rated_form = $dataForm['is_top_rated'];

  $views_product_form = 0;

  $date_create_form = $completeDate;

  $characteristicNames = $_POST['name_characteristic'];
  $characteristicValues = $_POST['value_characteristic'];

  $result_product = $pdo->prepare("SELECT * FROM product WHERE name_product = ? ORDER BY id ");
  $result_product->execute(array($name_product_form));
  $num_product = $result_product->rowCount();

  if ($num_product >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este produto já encontra-se cadastrada </div>"];
  } else {
    if (empty($name_product_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome do produto está vazio </div>"];
    } elseif (empty($description_product_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo descrição do produto  está vazio </div>"];
    } elseif (empty($new_price_product_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo preço do produto  está vazio </div>"];
    } elseif (empty($category_product_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo categoria do produto  está vazio </div>"];
    } elseif (empty($stock_product_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo stock do produto  está vazio </div>"];
    } else {

      foreach ($images_product_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($images_product_form['name'][$key], PATHINFO_EXTENSION);

        if ($images_product_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/products/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $images_product_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_products-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_products = 'http://localhost:8000/_imagesDb/products/' . $newName;
              array_push($images_array_product_form, $image_products);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_products = json_encode($images_array_product_form);

      if ($images_array_product_form == []) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não selecionou nenhuma imagem </div>"];
      } else {
        $sql = $pdo->prepare("INSERT INTO product values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $params = [
          $encode_images_array_products,
          $name_product_form,
          $description_product_form,
          $category_product_form,
          $old_price_product_form,
          $new_price_product_form,
          $stock_product_form,
          $product_store_form,
          $link_product_form,
          $is_best_sellers_form,
          $is_new_arrivals_form,
          $is_top_rated_form,
          $views_product_form,
          $date_create_form
        ];

        if ($sql->execute($params)) {
          $productId = $pdo->lastInsertId();

          $sql = "INSERT INTO characteristics (id_product, name_characteristic, value_characteristic) VALUES (:id_product, :name_characteristic, :value_characteristic)";
          $stmt = $pdo->prepare($sql);

          for ($i = 0; $i < count($characteristicNames); $i++) {
            $stmt->bindParam(':id_product', $productId);
            $stmt->bindParam(':name_characteristic', $characteristicNames[$i]);
            $stmt->bindParam(':value_characteristic', $characteristicValues[$i]);
            $stmt->execute();
          }

          $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Produto cadastrada com sucesso </div>"];
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar produto </div>"];
        };
      }
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_product') {
  $id_product = $_GET['idProduct'];

  $result_product = $pdo->prepare("SELECT * FROM product WHERE id = ? ORDER BY id LIMIT 1");
  $result_product->execute(array($id_product));
  $num_product = $result_product->rowCount();

  if ($num_product >= 1) {
    $row_product = $result_product->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_product];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum produto com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_product') {
  $id_product = $_GET['idProduct'];

  $result_product = $pdo->prepare("DELETE FROM product WHERE id=?");

  if ($result_product->execute(array($id_product))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o produto"];
  } else {
    $return = ['error' => true, 'msg' =>  "A produto não foi excluído :)"];
  }
}

if ($type_form == 'edite_product') {
  $id_product = $dataForm['idProduct'];

  $images_product_form = $_FILES['images_product'];
  $images_array_product_form = [];

  $name_product_form = $dataForm['name_product'];
  $description_product_form = $dataForm['description_product'];
  $old_price_product_form = $dataForm['old_price_product'];
  $new_price_product_form = $dataForm['new_price_product'];
  $category_product_form = $dataForm['category_product'];
  $stock_product_form = $dataForm['stock_product'];

  $product_store_form = $dataForm['product_store'];
  $link_product_form = '';
  if (isset($dataForm['link_product'])) {
    $link_product_form = $dataForm['link_product'];
  }
  $is_best_sellers_form = $dataForm['is_best_sellers'];
  $is_new_arrivals_form = $dataForm['is_new_arrivals'];
  $is_top_rated_form = $dataForm['is_top_rated'];

  $characteristicNames = $_POST['name_characteristic'];
  $characteristicValues = $_POST['value_characteristic'];

  $return = "";

  if (empty($name_product_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome do produto está vazio </div>"];
  } elseif (empty($description_product_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo descrição está vazio </div>"];
  } elseif (empty($new_price_product_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo preço está vazio </div>"];
  } elseif (empty($category_product_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo categoria está vazio </div>"];
  } elseif (empty($stock_product_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O estado do stock não foi selecionado </div>"];
  } else {

    foreach ($images_product_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($images_product_form['name'][$key], PATHINFO_EXTENSION);

      if ($images_product_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {

        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/products/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $images_product_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_products-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_products = 'http://localhost:8000/_imagesDb/products/' . $newName;
            array_push($images_array_product_form, $image_products);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_products = json_encode($images_array_product_form);

    if ($images_array_product_form == []) {
      $sql = $pdo->prepare("UPDATE product SET name_product=?, description_product=?, old_price_product=?, new_price_product=?, category_product=?, stock_product=?, product_store=?, link_product=?, is_best_sellers=?, is_new_arrivals=?, is_top_rated=? WHERE id=? ");

      $params = [
        $name_product_form,
        $description_product_form,
        $old_price_product_form,
        $new_price_product_form,
        $category_product_form,
        $stock_product_form,
        $product_store_form,
        $link_product_form,
        $is_best_sellers_form,
        $is_new_arrivals_form,
        $is_top_rated_form,
        $id_product
      ];

      if ($sql->execute($params)) {
        $sql = "INSERT INTO characteristics (id_product, name_characteristic, value_characteristic) VALUES (:id_product, :name_characteristic, :value_characteristic)";
        $stmt = $pdo->prepare($sql);

        $sql_update = $pdo->prepare("UPDATE characteristics SET name_characteristic=?, value_characteristic=? WHERE id_product=? AND name_characteristic=? ");

        // Para cada Caracteristica
        for ($i = 0; $i < count($characteristicNames); $i++) {
          // Ver se Essa carcterista já exite
          $result_characteristics = $pdo->prepare("SELECT * FROM characteristics WHERE id_product = ? AND name_characteristic = ? ORDER BY id LIMIT 1");
          $result_characteristics->execute(array($id_product, $characteristicNames[$i]));
          $num_characteristics = $result_characteristics->rowCount();

          if ($num_characteristics >= 1) {
            // Se já existe, atualizer o valor
            $exist_characteristic = 'Está caraceristica já existe';

            $params_update = [
              $characteristicNames[$i],
              $characteristicValues[$i],
              $id_product,
              $characteristicNames[$i]
            ];

            $sql_update->execute($params_update);
          } else {
            $stmt->bindParam(':id_product', $id_product);
            $stmt->bindParam(':name_characteristic', $characteristicNames[$i]);
            $stmt->bindParam(':value_characteristic', $characteristicValues[$i]);
            $stmt->execute();
          }
        }

        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados da produto actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados da produto </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE product SET images_product=?, name_product=?, description_product=?, old_price_product=?, new_price_product=?, category_product=?, stock_product=?, product_store=?, link_product=?, is_best_sellers=?, is_new_arrivals=?, is_top_rated=? WHERE id=? ");

      $params = [
        $encode_images_array_products,
        $name_product_form,
        $description_product_form,
        $old_price_product_form,
        $new_price_product_form,
        $category_product_form,
        $stock_product_form,
        $product_store_form,
        $link_product_form,
        $is_best_sellers_form,
        $is_new_arrivals_form,
        $is_top_rated_form,
        $id_product
      ];

      if ($sql->execute($params)) {

        $sql = "INSERT INTO characteristics (id_product, name_characteristic, value_characteristic) VALUES (:id_product, :name_characteristic, :value_characteristic)";
        $stmt = $pdo->prepare($sql);

        $sql_update = $pdo->prepare("UPDATE characteristics SET name_characteristic=?, value_characteristic=? WHERE id_product=? AND name_characteristic=? ");

        // Para cada Caracteristica
        for ($i = 0; $i < count($characteristicNames); $i++) {
          // Ver se Essa carcterista já exite
          $result_characteristics = $pdo->prepare("SELECT * FROM characteristics WHERE id_product = ? AND name_characteristic = ? ORDER BY id LIMIT 1");
          $result_characteristics->execute(array($id_product, $characteristicNames[$i]));
          $num_characteristics = $result_characteristics->rowCount();

          if ($num_characteristics >= 1) {
            // Se já existe, atualizer o valor
            $exist_characteristic = 'Está caraceristica já existe';

            $params_update = [
              $characteristicNames[$i],
              $characteristicValues[$i],
              $id_product,
              $characteristicNames[$i]
            ];

            $sql_update->execute($params_update);
          } else {
            $stmt->bindParam(':id_product', $id_product);
            $stmt->bindParam(':name_characteristic', $characteristicNames[$i]);
            $stmt->bindParam(':value_characteristic', $characteristicValues[$i]);
            $stmt->execute();
          }
        }

        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados da produto actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados da produto </div>"];
      };
    }
  }
  echo json_encode($return);
}

if ($type_form == 'get_all_category') {
  $result_category = $pdo->prepare("SELECT * FROM category");
  $result_category->execute();
  $row_category = $result_category->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($row_category);
}
