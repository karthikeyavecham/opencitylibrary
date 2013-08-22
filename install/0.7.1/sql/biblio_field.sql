drop table if exists %prfx%biblio_field;
create table %prfx%biblio_field (
  bibid integer not null
  ,fieldid integer not null
  ,tag smallint not null
  ,ind1_cd char(1) null
  ,ind2_cd char(1) null
  ,subfield_cd char(1) not null
  ,field_data text null
  ,FOREIGN KEY (bibid) REFERENCES biblio(bibid)
  ,primary key(bibid,fieldid)
  )
  ENGINE=InnoDB
;
