ALTER TABLE usermanagement RENAME Customers;
ALTER TABLE policiesforoldmgtm RENAME Policies;
ALTER TABLE cutvone RENAME payments;

ALTER TABLE  Customers DROP date_expiration;
ALTER TABLE  Customers DROP date_exp_adc;
ALTER TABLE  Customers DROP email_info;
ALTER TABLE  Customers DROP bank_info;
ALTER TABLE  Customers DROP adcsinged;
ALTER TABLE  Customers DROP proofop;
ALTER TABLE  Customers DROP pictures;
ALTER TABLE  Customers DROP registration;
ALTER TABLE  Customers DROP driverLicense;
ALTER TABLE  Customers DROP phoneNumber;
ALTER TABLE  Customers DROP aplication;
ALTER TABLE  Customers DROP DateModifyDaysP;
ALTER TABLE  Customers DROP nextpaydate;
ALTER TABLE  Customers DROP fecha_mod_satus;
ALTER TABLE  Customers DROP user_group;
ALTER TABLE  Customers DROP CountPendingDays;
ALTER TABLE  Customers DROP DateOfPrending;
ALTER TABLE  Customers DROP ADC;

ALTER TABLE  Customers DROP credit;
ALTER TABLE  Customers DROP policynumber;
ALTER TABLE  Customers DROP policy_type;
ALTER TABLE  Customers DROP pagomensual;


ALTER TABLE  Customers DROP dealer;
ALTER TABLE  Customers DROP compania;
ALTER TABLE  Customers DROP total;
ALTER TABLE  Customers DROP agcode;
ALTER TABLE  Customers DROP service;

ALTER TABLE  Customers DROP nota;
ALTER TABLE  Customers DROP status_client;	
ALTER TABLE  Customers DROP pagomensualdrivers;

ALTER TABLE Customers ADD COLUMN adc_number VARCHAR(25) AFTER date_update;

ALTER TABLE `Customers` CHANGE COLUMN `id_usurio` `id_usuario` INT(11) NOT NULL;
ALTER TABLE `Customers` ADD CONSTRAINT fk_users_id FOREIGN KEY (id_usuario) REFERENCES users(id);
ALTER TABLE `payments` ADD CONSTRAINT policies FOREIGN KEY (id_policy) REFERENCES policies(Id);

//ALTER TABLE `policies` ADD CONSTRAINT fk_policies_id FOREIGN KEY (Id) REFERENCES payments(id_policy);


ALTER TABLE Customers RENAME COLUMN id_usurio	 TO id_usuario; 





ALTER TABLE Customers RENAME COLUMN old_col_name TO new_col_name;
ALTER TABLE Customers RENAME COLUMN old_col_name TO new_col_name;
ALTER TABLE Customers RENAME COLUMN old_col_name TO new_col_name;
ALTER TABLE Customers RENAME COLUMN old_col_name TO new_col_name;

