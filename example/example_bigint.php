<?php

require __DIR__ .'/../vendor/autoload.php';
require __DIR__ .'/../lib/Base62.php';


// unsigned bigint 18446744073709551615
$id = new Math_BigInteger('18446744073709551615', 10);

// print encoded base62 number id
echo "Base62 bigint encoded: ". Base62::encode($id) ."\n";
// print decoded base62 data
echo "Decoded Base62: ". Base62::decode(Base62::encode($id));