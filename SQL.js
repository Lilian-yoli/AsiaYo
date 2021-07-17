// SQL題-1
`SELECT p.name, count(p.id) as bnb_count FROM property p 
    INNER JOIN room r ON p.id = r.property_id 
    GROUP BY p.id ORDER BY bnb_count DESC LIMIT 10`

// SQL題-2
`SELECT p.name, count(p.id) AS bnb_count from property p
    INNER JOIN room r ON p.id = r.property_id
    INNER JOIN orders o ON r.id = o.room_id
    WHERE o.created_at BETWEEN "2021-02-01" AND "2021-02-28 23:59:59"
    GROUP BY p.id ORDER BY bnb_count DESC LIMIT 10`