CREATE TYPE redes.marca_switch AS ENUM ('Linksys', 'Extreme', 'Datacom', 'Cisco');
CREATE TYPE redes.status_vlan AS ENUM ('LIVRE', 'EM USO', 'RESERVADA', 'TEMPORÁRIA');
CREATE TYPE redes.port_type AS ENUM ('FE', 'GE', '10GE');
CREATE TYPE redes.port_mode AS ENUM ('ACCESS', 'TRUNK', 'DYNAMIC', 'DESIRABLE', 'AUTO MODES');
