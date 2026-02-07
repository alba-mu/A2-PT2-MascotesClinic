# 🏥 Mascotes Clinic - Sistema de Gestió de Clínica Veterinària

Sistema web de gestió per a clíniques veterinàries desenvolupat amb PHP seguint el patró MVC (Model-View-Controller). Permet gestionar propietaris, mascotes i el seu historial mèdic.

## 📋 Descripció del Projecte

**Mascotes Clinic** és una aplicació web desenvolupada en PHP que implementa un sistema de gestió integral per a clíniques veterinàries. El sistema permet:

- ✅ Gestionar propietaris de mascotes (consulta i modificació)
- ✅ Gestionar mascotes i la seva associació amb propietaris
- ✅ Mantenir un historial mèdic detallat de cada mascota
- ✅ Buscar i visualitzar informació de manera eficient
- ✅ Interfície d'usuari moderna amb Bootstrap 5

## 🏗️ Estructura de Directoris

```
A2-PT2-MascotesClinic/
│
├── index.php                           # Punt d'entrada principal de l'aplicació
├── mascotesclinic_MUÑOZAlba.sql      # Script SQL per crear la base de dades
│
├── controller/                         # Controladors (Capa de Control)
│   ├── MainController.class.php       # Controlador principal que enruta les peticions
│   ├── OwnerController.class.php      # Gestió de propietaris
│   └── PetController.class.php        # Gestió de mascotes
│
├── model/                              # Models (Capa de Negoci i Entitats)
│   ├── Owner.class.php                # Entitat Propietari
│   ├── OwnerModel.class.php           # Lògica de negoci de propietaris
│   ├── Pet.class.php                  # Entitat Mascota
│   ├── PetModel.class.php             # Lògica de negoci de mascotes
│   ├── PetHistory.class.php           # Entitat Historial Mèdic
│   ├── HistoryModel.class.php         # Lògica de negoci de l'historial
│   └── persist/                       # Capa d'accés a dades (DAO)
│       ├── OwnerDbDAO.class.php       # Accés a dades de propietaris
│       ├── PetDbDAO.class.php         # Accés a dades de mascotes
│       └── HistoryDbDAO.class.php     # Accés a dades de l'historial
│
├── view/                               # Vistes (Capa de Presentació)
│   ├── HomePage.php                   # Pàgina d'inici
│   ├── OwnerView.class.php            # Vista de propietaris
│   ├── PetView.class.php              # Vista de mascotes
│   ├── css/                           # Estils personalitzats
│   │   └── custom-style.css
│   ├── js/                            # Scripts JavaScript
│   │   └── general-fn.js
│   ├── img/                           # Imatges
│   │   └── proven.jpg
│   ├── menu/                          # Components del menú
│   │   └── MainMenu.html
│   └── form/                          # Formularis
│       ├── MessageForm.php
│       ├── OwnerList.php
│       ├── OwnerFormSearchPets.php
│       ├── OwnerFormModify.php
│       ├── PetList.php
│       ├── PetDetail.php
│       └── ...
│
└── util/                               # Utilitats i helpers
    ├── OwnerMessage.class.php         # Missatges per a propietaris
    ├── OwnerFormValidation.class.php  # Validació de formularis de propietaris
    ├── PetMessage.class.php           # Missatges per a mascotes
    └── PetFormValidation.class.php    # Validació de formularis de mascotes
```

## 🎯 Arquitectura MVC

El projecte segueix el patró **Model-View-Controller**:

### **Model (Capa de Dades i Lògica de Negoci)**
- **Entitats**: Classes que representen les taules de la base de dades (`Owner`, `Pet`, `PetHistory`)
- **Models**: Gestionen la lògica de negoci (`OwnerModel`, `PetModel`, `HistoryModel`)
- **DAO**: Capa de persistència que gestiona l'accés directe a la base de dades

### **View (Capa de Presentació)**
- Classes de vista que renderitzen les plantilles HTML
- Formularis i llistes per a la interacció amb l'usuari
- Ús de Bootstrap 5 per a un disseny responsive i modern

### **Controller (Capa de Control)**
- Processa les peticions HTTP (GET/POST)
- Coordina entre Model i View
- Gestiona la validació de formularis i el flux de l'aplicació

## 🗄️ Base de Dades

El sistema utilitza **MySQL** amb les següents taules:

### Taules Principals:

1. **propietaris** (Propietaris)
   - `id`, `nom`, `email`, `movil`

2. **mascotes** (Mascotes)
   - `id`, `nom`, `propietari_id` (FK → propietaris)

3. **historial** (Historial Mèdic)
   - `id`, `data`, `motiu_visita`, `descripcio`, `mascota_id` (FK → mascotes)

### Relacions:
- Un propietari pot tenir múltiples mascotes (1:N)
- Una mascota té múltiples registres d'historial (1:N)

## 🚀 Com Arrencar el Projecte

### Prerequisits

- **PHP 7.4+** (preferiblement PHP 8.x)
- **MySQL 5.7+** o **MariaDB**
- **Servidor web**: Apache, Nginx o el servidor integrat de PHP

### Instal·lació Pas a Pas

#### 1️⃣ **Clonar o descarregar el repositori**

```bash
git clone https://github.com/alba-mu/A2-PT2-MascotesClinic.git
cd A2-PT2-MascotesClinic
```

#### 2️⃣ **Configurar la base de dades**

Importa l'script SQL per crear la base de dades i les taules:

```bash
mysql -u root -p < mascotesclinic_MUÑOZAlba.sql
```

O manualment:

1. Obre phpMyAdmin o el teu client MySQL
2. Executa el contingut del fitxer `mascotesclinic_MUÑOZAlba.sql`
3. Això crearà:
   - La base de dades `mascotesClinic`
   - L'usuari `user` amb contrasenya `password`
   - Les taules amb dades de prova

#### 3️⃣ **Configurar la connexió a la base de dades**

Revisa i modifica (si cal) els fitxers DAO ubicats a `model/persist/`:
- `OwnerDbDAO.class.php`
- `PetDbDAO.class.php`
- `HistoryDbDAO.class.php`

Busca la configuració de connexió (normalment al mètode de connexió o singleton):

```php
$host = 'localhost';
$dbname = 'mascotesClinic';
$username = 'user';
$password = 'password';
```

Ajusta aquests valors segons la teva configuració local.

#### 4️⃣ **Arrencar el servidor**

**Opció A: Servidor integrat de PHP**

```bash
php -S localhost:8000
```

Accedeix a: `http://localhost:8000`

**Opció B: Apache/XAMPP/MAMP**

1. Copia el projecte a la carpeta `htdocs` (XAMPP) o `www` (WAMP)
2. Accedeix a: `http://localhost/A2-PT2-MascotesClinic`

**Opció C: Docker (opcional)**

```bash
docker-compose up -d
```

## 📱 Funcionalitats Principals

### Gestió de Propietaris
- Llistar tots els propietaris
- Buscar propietaris per ID
- Modificar dades dels propietaris
- Veure les mascotes d'un propietari

### Gestió de Mascotes
- Llistar totes les mascotes
- Buscar mascotes per ID
- Modificar dades de les mascotes
- Veure detalls complets (propietari + historial)

### Gestió d'Historial Mèdic
- Afegir noves entrades a l'historial
- Consultar l'historial complet d'una mascota

## 🛠️ Tecnologies Utilitzades

- **Backend**: PHP 7.4+
- **Base de Dades**: MySQL 5.7+ / MariaDB
- **Frontend**: 
  - HTML5
  - CSS3 (amb CSS personalitzat)
  - Bootstrap 5.0.2
  - Bootstrap Icons 1.11.3
  - JavaScript (Vanilla JS)
- **Patró de Disseny**: MVC (Model-View-Controller)
- **Arquitectura**: 3 capes (Presentació, Lògica de Negoci, Accés a Dades)

## 📦 Dependències

El projecte utilitza recursos CDN, per tant **no requereix instal·lació de paquets**:

- Bootstrap 5.0.2 (CSS + JS)
- Bootstrap Icons 1.11.3

## 🔐 Credencials de Base de Dades

**Per defecte** (definides a l'script SQL):

- **Usuari**: `user`
- **Contrasenya**: `password`
- **Base de dades**: `mascotesClinic`
- **Host**: `localhost`

⚠️ **Nota de Seguretat**: Canvia aquestes credencials en un entorn de producció.

## 👥 Autor

**Alba Muñoz**  
Institut Provençana - Projecte A2-PT2

## 📄 Llicència

Aquest projecte és un treball acadèmic desenvolupat per l'Institut Provençana.

---

## 📝 Notes Addicionals

- El projecte inclou dades de prova per facilitar les proves
- Tots els missatges d'error i validació estan centralitzats a les classes `*Message` i `*FormValidation`
- La interfície està en català
- El sistema utilitza sessions PHP per gestionar missatges i estat

## 🐛 Resolució de Problemes

### Error de connexió a la base de dades
✅ Verifica que MySQL estigui en execució  
✅ Comprova les credencials als fitxers DAO  
✅ Assegura't que la base de dades `mascotesClinic` existeix

### Error 404 o pàgina en blanc
✅ Verifica que el servidor apunti al directori correcte  
✅ Comprova els permisos dels fitxers (755 per directoris, 644 per fitxers)  
✅ Revisa els logs d'error de PHP

### Estils no es carreguen
✅ Verifica la ruta base a `index.php`  
✅ Comprova la connexió a Internet (Bootstrap via CDN)

---

💡 **Per a més informació o dubtes, consulta el codi font o contacta amb l'autor.**
