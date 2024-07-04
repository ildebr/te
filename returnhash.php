<?php

// $algo = password_hash('contrasena', PASSWORD_DEFAULT);
// echo($algo);
echo(hash('sha1', 'contrasena'));

// echo('a  '.password_verify('contrasena', $algo));

echo(password_verify('contrasena', '$2y$10$YDvJbK2KorHPixCwB6oiCe4Wfn0l4HTk2H3AcOHV9vTyVrOGymxyGa1'));