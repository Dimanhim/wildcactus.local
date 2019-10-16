$form = new FormPage();
        if ($form->load(Yii::$app->request->post())) {
            $name = $form->name;
            $phone = $form->phone;
            $email = $form->email;
            $list = $form->list;
            $btn = $form->btn;
            $orders = new Lan_orders();
            if($name != null) $orders->name = $name;
            if($phone != null) $orders->phone = $phone;
            if($email != null) $orders->email = $email;
            if($list != null) $orders->plan = $list;
            if($btn != null) $orders->btn = $btn;
            $orders->date_order = time();
            $orders->split = $page;
            $orders->status = 4;
            $orders->utm_source = $utm_source;
            $orders->utm_campaign = $utm_campaign;
            $orders->utm_medium = $utm_medium;
            $orders->utm_content = $utm_content;
            $orders->utm_term = $utm_term;
            
            if($orders->save()) {
            $admin = Options::find()->select(['name'])->one()->name;
            $mail = Options::find()->select(['email'])->one()->email;
            $mailname = Options::find()->select(['mailname'])->one()->mailname;
            $site = $mailname;
            $subject = 'Заполнена контактная форма с сайта '.$site;
            if(
            Yii::$app->mailer->compose('user', ['site' => $site, 'admin' => $admin, 'name' => $name, 'phone' => $phone, 'email' => $email, 'list' => $list, 'btn' => $btn])
                ->setFrom(['info@minimba.ru' => $mailname])
                 ->setTo($mail)
                ->setSubject($subject)
                ->setTextBody(' ')
                ->send()
            ) $success = true;
            }
            else $success = false;
        }