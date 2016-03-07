
DROP TABLE IF EXISTS category;

CREATE TABLE category ( /*分類(主鍵:cat_id)*/
  id 				INTEGER PRIMARY KEY AUTOINCREMENT 	/*分類ID(主鍵)*/,
  name 				VARCHAR(32) NOT NULL				/*分類英文名稱*/,
  remark 			VARCHAR(256) 						/*備註*/,
                                                                
  entry_date 		DATETIME NOT NULL					/*建立時間*/,
  modify_date		DATETIME NOT NULL					/*修改時間*/
);

CREATE INDEX category_pk ON category (id ASC);
