import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ProductosProvider } from '../../providers/productos';


@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  constructor(public navCtrl: NavController,
              public ps:ProductosProvider) {

  }

  siguiente_pagina( infiniteScroll ){

    this.ps.cargar_todos()
          .then( ()=>{

            infiniteScroll.complete();

          })


  }

}
