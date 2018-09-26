import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { URL_SERVICIOS } from '../config/url.services';

@Injectable()
export class ProductosProvider {

  pagina:number = 0;
  productos:any[] = [];
  constructor(public http: HttpClient) {
    this.cargar_todos();
  }

  cargar_todos() {

      let promesa = new Promise(  (resolve, reject)=>{

        let url = URL_SERVICIOS + 'cargarAllProducts'+"/1";

        //new Angular HttpClient service
        this.http.get(url)
          .subscribe(data => {   // data is already a JSON object
              console.log(data);

              let nuevaData = this.agrupar( data["result"], 2 );
              this.productos = nuevaData;
              this.pagina += 1;
              console.log(data["result"]);
              resolve();
          });

      });

      return promesa;

  }

  private agrupar( arr:any, tamano:number ){

    let nuevoArreglo = [];
    for( let i = 0; i<arr.length; i+=tamano ){
      nuevoArreglo.push( arr.slice(i, i+tamano) );
    }
    console.log( nuevoArreglo );
    return nuevoArreglo;

  }

}
