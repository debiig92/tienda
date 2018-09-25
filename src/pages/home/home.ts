import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ProductosProvider } from '../../providers/productos';
import { URL_IMAGENES } from '../../config/url.services';


@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  urlImages:string = URL_IMAGENES;
  constructor(public navCtrl: NavController,
              public ps:ProductosProvider) {

  }

}
