1. 請寫出一條查詢語句 (SQL),列出在 2023 年 5 月下訂的訂單,使用台幣付款且5月總金額最多的前 10 筆的旅宿 ID (bnb_id), 旅宿名稱 (bnb_name), 5 月總金額 (may_amount)

    ```
    SELECT 
        bnbs.id, bnbs.name, SUM(o.amount) AS total_amount
    FROM
        bnbs
    JOIN
        orders o ON bnbs.id = o.bnb_id AND o.currency = 'TWD'
    WHERE
        o.created_at BETWEEN '2023-05-01' AND '2023-05-31'
    GROUP BY
        bnbs.id, bnbs.name
    ORDER BY
        o.amount DESC
    LIMIT 10
    ```

2. 在題目一的執行下,我們發現 SQL 執行速度很慢,您會怎麼去優化?請闡述您怎麼判斷與優化的方式

* 使用EXPLAIN查看SQL query的查詢策略  
  策略type若是All表示全表搜尋，需要避免這個狀況，了解查詢的瓶頸是在哪個步驟。

* 設定index
  在bnbs.id, order.bnb_id, order.currency, 和 created_at設定index。
  ```
  CREATE INDEX idx_bnbs_id ON bnbs (id);
  CREATE INDEX idx_orders_bnb_id_currency_created_at ON orders (bnb_id, currency, created_at);
  ```

* 縮小查詢範圍
  ```
  WITH top_ten_amount AS (
	SELECT
		bnb_id, SUM(amount) AS total_amount
	FROM
		order
	WHERE
		created_at BETWEEN '2023-05-01' AND '2023-05-31'
	GROUP BY
		bnbs.id, bnbs.name
	ORDER BY
		o.amount DESC
	LIMIT 10
  )
  SELECT
	  bnbs.id, bnbs.name, TTA.total_amount
  FROM
	  top_ten_amount AS TTA
  JOIN
	  bnbs ON TTA.bnb_id = bnbs.id
    ```

* 分區（Partitioning）
  按照日期範圍（例如 created_at）進行分區。
  ```
  ALTER TABLE orders PARTITION BY RANGE (YEAR(created_at)) (
    PARTITION p2023 VALUES LESS THAN (2024),
    PARTITION p2024 VALUES LESS THAN (2025)
  );
  ```

 * 提高 InnoDB 緩存池大小
 


  