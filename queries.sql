
-- filter flights
SELECT * FROM flight WHERE source LIKE 'Chittagong Int. Airport' AND destination LIKE 'Shajalal Int. Airport' AND Date(departure) = '2024-03-31' AND price >= 2500 AND price <= 15000 AND airline IN ('Biman Bangladesh Airlines', 'Dubai Airways');