<?php
require_once 'mysql_helper.php';
require_once 'init.php';

function renderTemplate ($template_path, $data) {
    if(is_file($template_path)) {
        foreach($data as $key => $value) {
            ${$key} = $value;
        }
        ob_start();
        require_once($template_path);
        return ob_get_clean();        
        } else {
            return '';
        }
};

function get_past_time ($date) {
    $date = strtotime($date);
    $time_past = time() - $date;
    if ($time_past >= 86400) {
        return date('d.m.y в H:i', $date);
    } elseif ($time_past < 3600) {
        return (string)floor($time_past / 60) . ' минут назад'; 
    } else {
        return (string)floor($time_past / 3600) . ' часов назад';
    }
};

function get_time_left ($expire_date) {
    $expire_date = strtotime($expire_date);
    $time_left = $expire_date - time();
    return date('d H:i', $time_left);
}

function is_time_left ($expire_date) {
    $expire_date = strtotime($expire_date);
    $time_left = $expire_date - time();
    return $time_left > 0;
}

function validateNumber($value) {
    return filter_var($value, FILTER_VALIDATE_INT);
};

function validateEmail($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
};

function validateImageType($field_name) {
    $mime_super_type = explode('/', $_FILES[$field_name]['type'])[0];
    return $mime_super_type == 'image' ? true : false;
}

function searchUserByEmail($link, $email) {
    $sql = 'SELECT * FROM users WHERE email = "' .$email.'"';
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row;
};

function get_user_bets($link, $user_id) {
    $sql = 'SELECT b.date as time, b.cost, l.name, l.picture, l.date, c.category, b.lot_id FROM bets b LEFT JOIN lots l ON b.lot_id = l.id LEFT JOIN categories c ON l.category_id = c.id WHERE b.user_id = "' .$user_id.'" ORDER BY b.date';
    $result = mysqli_query($link, $sql);

    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : false;
}

function check_author($link, $user_id, $item_id) {
    $sql = 'SELECT author_id FROM lots WHERE author_id = "' .$user_id.'" and id = "' .$item_id.'"';
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC) ? true : false;
}

function find_matching_in_array($array, $array_key, $matching_value) {
    foreach ($array as $value) {
        if ($value[$array_key] == $matching_value) {
            return true;
        }
    }
    return false;
}

function render_error ($title, $error, $error_message) {
    $page_content = renderTemplate('./templates/error.php', ['message' => $error_message, 'error' => $error]);
    $layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => [], 'user' => null]);
    print($layout_content);
    exit;
}

function find_row($link, $id) {
    $sql = 'SELECT id FROM lots WHERE id =' .$id;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row ? true : false;
}

function get_lot_bets($link, $lot_id) {
    $sql = 'SELECT b.*, u.name FROM bets b LEFT JOIN users u ON b.user_id = u.id  WHERE b.lot_id = '.$lot_id.' ORDER BY b.date';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}

function get_current_lot($link, $lot_id) {
    $sql = 'SELECT l.*, c.category FROM lots l LEFT JOIN categories c ON l.category_id = c.id WHERE l.id =' .$lot_id;
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}

function get_lots_list($link) {
    $sql = 'SELECT l.id, l.date, l.name, l.picture, l.price, l.expire_date, c.category FROM lots l LEFT JOIN categories c ON l.category_id = c.id  WHERE l.winner_id IS NULL ORDER BY l.id';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}

function get_category_list($link) {
    $sql = 'SELECT category FROM categories ORDER BY id';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $categories = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $cat_name = $row['category'];
            $categories[] = $cat_name;
        }
        return $categories;
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}

function get_category_id($link, $category) {
    $sql = 'SELECT id FROM categories WHERE category = "' .$category.'"';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}

function get_last_id($link, $table) {
    $sql = 'SELECT id FROM "' .$table.'" ORDER BY id DESC LIMIT 1';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
    }
}
 ?>