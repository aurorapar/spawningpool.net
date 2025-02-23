<?php
    // =============================
    //    Game Servers Configuration
    // =============================

    $servers_and_ports = array(
        3389 => "Remote Connections",
        80 => "Web Server",
        443 => "Web Server (SSL)",
        7777 => "ARK: Survival Evolved",
        25565 => "Minecraft",
        26900 => "7 Days To Die",
        12345 => "Cube World",
        27015 => "Counter-Strike / Valve Games",
        3000  => "Eco",
        9876 => "V Rising",
        2456 => "Valheim",
        27016 => "Space Engineers",
    );
    $hidden_ports = [3389, 22];
    $game_status_cache = "server_status.json";

    $game_statuses = get_game_statuses($servers_and_ports, $game_status_cache, $hidden_ports);
    // $web_contents['Servers'] = print_r($game_statuses, true);
    $web_contents['Servers'] = format_game_statuses($game_statuses);

    function format_game_statuses($game_statuses)
    {
        $dateFormat = 'Y/m/d h:i A'; // Used in date() function

        $output = '
            Last Updated: ' . date($dateFormat, $game_statuses['Last Updated']) . '
            <div class="running_servers">
                <h3>Running</h3>
        ';

        foreach($game_statuses["Running"] as $index => $server)
        {
            $output = $output . $server;
            if($index + 1 != count($game_statuses["Running"]))
                $output = $output . '<br>';
        }

        $output = $output . '
            </div>
            <div class="stopped_servers">
                <h3>Stopped Servers</h3>
        ';
        foreach($game_statuses["Not Running"] as $server_name)
                $output = $output . $server_name . '<br>';
        $output = $output . '
            </div>
        ';

        return $output;
    }

    function get_game_statuses($games_list, $game_status_cache, $hidden_ports)
    {
        $game_statuses = array("Running" => array(), "Not Running" => array());
        if(file_exists($game_status_cache))
        {
            $game_statuses = json_decode(fread(fopen($game_status_cache, 'r'), filesize($game_status_cache)), true);
        }
        else
        {
            $game_statuses["Last Updated"] = 0;
        }
        if(time() - $game_statuses["Last Updated"] < 60*1) # minutes
        {
            return $game_statuses;
        }
        $running_games = array();
        $stopped_games = array();
        $host = file_get_contents("http://ipecho.net/plain");
        $steam_servers = json_decode(file_get_contents(
            "http://api.steampowered.com/ISteamApps/GetServersAtAddress/v0001?addr=" . $host . "&format=json"
        ));
        $steam_servers = json_decode(json_encode($steam_servers), true);
        foreach($games_list as $port => $server)
        {
            if(game_server_running($host, $port, $steam_servers))
            {
                $server_description = $server;
                if(!in_array($port, $hidden_ports))
                    $server_description = $server_description . "&nbsp;&nbsp;&nbsp;&nbsp;" . $host . ":" . $port;
                array_push($running_games, $server_description);
            }
            else
            {
                array_push($stopped_games, $server);
            }
        }
        $game_statuses["Running"] = $running_games;
        $game_statuses["Not Running"] = $stopped_games;
        $game_statuses["Last Updated"] = time();
        $file_stream = fopen($game_status_cache, "w");
        if(!$file_stream)
            return $file_stream;
        fwrite($file_stream, json_encode($game_statuses));
        fclose($file_stream);
        return $game_statuses;
    }

    function game_server_running($host, $game_server_port, $steam_servers)
    {
        // This works fine for TCP
        $connection = @fsockopen($host, $game_server_port, $errno, $errstr, 1);
        if (is_resource($connection))
        {
            return true;
        }

        foreach($steam_servers["response"]["servers"] as $server_array => $values)
        {
            if($values["gameport"] == $game_server_port)
            {
                return true;
            }
        }

        return false;
    }
?>