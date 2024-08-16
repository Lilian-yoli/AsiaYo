#### 資料庫測驗 -> [SQL-TEST.md](https://github.com/Lilian-yoli/AsiaYo/blob/main/SQL-TEST.md)

#### API實作測驗
- SOLID原則
  - 單一職責原則:  
    OrdersController: 僅負責處理與訂單相關的 HTTP 請求。
    OrdersService: 專注於訂單數據的驗證和轉換。
  - 依賴反轉原則：   
    OrdersService 依賴於 ValidationFactory 來進行數據驗證，而不是直接依賴具體的驗證實現。
  - 開放封閉原則:  
    OrdersService: 可以透過擴展新方法來增加功能，例如添加更多的驗證規則或數據轉換邏輯，而不需要修改現有的代碼。

- 設計模式
  - 依賴注入
    OrdersController 透過`__construct`注入 OrdersService，而OrdersService 則注入了 ValidationFactory。
  - 工廠模式
    在 OrdersService 中，$validator->make((array) $data, $rule, $message) 根據不同的規則創建驗證器實例。

#### 啟用App
```
docker compose up --build -d
```


