
<style>
    /*
    Import the desired font from Google fonts.
    */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
    
    /*
    With this CSS property you could define whether you want a HTML form field to be
    used as input in the PDF or not.
    
    https://docraptor.com/documentation/article/7321187-forms
    */
    input, select{
      -prince-pdf-form: enable;
    }
    
    /* 
    Define colors and sizing elements used in this template
    */
    :root{
      --font-color: black;
      --highlight-color: #00a5ce;
      --secondary-color: #868f95;
      --header-bg-color: #B8E6F1;
      --footer-bg-color: #BFC0C3;
      --table-img-bg-color: #BFC0C3;
      --gap-size: 15px;
    }
    
    @page{
      /*
      This CSS highlights how page sizes, margins, and margin boxes are set.
      https://docraptor.com/documentation/article/1067959-size-dimensions-orientation
    
      Within the page margin boxes content from running elements is used instead of a 
      standard content string. The name which is passed in the element() function can
      be found in the CSS code below in a position property and is defined there by 
      the running() function.
      */
      size:A4;
      margin:4cm 0 3cm 0;
    
      @top-left{
        content:element(header);
      }
    
      @bottom-left{
        content:element(footer);
      }
    }
    
    * {
      box-sizing: border-box;
    }
    
    /* 
    The body itself has no margin but a padding top & bottom 1cm and left & right 2cm.
    Additionally the default font family, size and color for the document is defined
    here.
    */
    body{
      margin:0;
      padding:1cm 2cm;
      color:var(--font-color);
      font-family:'Montserrat', sans-serif;
      font-size:10pt;
    }
    
    /*
    The links in the document should not be highlighted by an different color and underline
    instead we use the color value inherit to get the current text's color.
    */
    a{
      color:inherit;
      text-decoration:none;
    }
    
    /*
    For the dividers in the document we use an HR element with a margin top and bottom 
    of 1cm, no height and only a border top of one millimeter.
    */
    hr{
      margin: 0.8cm 0;
      height:0;
      border:0;
      border-top:1mm solid var(--highlight-color);
    }
    
    /*
    The page header in our document uses the HTML HEADER element, we define a height 
    of 4cm matching the margin top of the page (see @page rule) and a padding left
    and right of 2cm. We did not give the page itself a margin of 2cm to ensure that
    the background color goes to the edges of the document.
    
    As mentioned above in the comment for the @page the position property with the 
    value running(header) makes this HTML element float into the top left page margin
    box. This page margin box repeats on every page in case we would have a multi-page
    packing slip.
    */
    header{
      height:4cm;
      padding:0 2cm;
      position:running(header);
      /* background-color:var(--header-bg-color); */
    }
    
    /*
    For the different sections in the header we use some flexbox and keep space between
    with the justify-content property.
    */
    header .headerSection{
      display:flex;
      height:4cm;
      align-items: center;
      justify-content:space-between;
    }
    
    /*
    To move the first sections a little down and have more space between the top of 
    the document and the logo/company name we give the section a padding top of 5mm.
    */
    header .headerSection:first-child{
      padding-top:.5cm;
    }
    
    /*
    Similar we keep some space at the bottom of the header with the padding-bottom
    property.
    */
    header .headerSection:last-child{
      padding-bottom:.5cm;
    }
    
    /*
    Within the header sections we have defined two DIV elements, and the last one in
    each headerSection element should only take 35% of the headers width.
    */
    header .headerSection div:last-child{
      width:35%;
      margin-top:1cm;
    }
    
    /*
    The last child in the second header section should not be restricted to a 35% width.
    */
    header .headerSection:last-child div:last-child{
      width:auto;
    }
    
    /*
    For the logo, where we use an SVG image and the company text we also use flexbox
    to align them correctly.
    */
    header .logoAndName{
      display:flex;
      align-items:center;
      justify-content:space-between;
    }
    
    /*
    The SVG gets set to a fixed size and get 5mm margin right to keep some distance
    to the company name.
    */
    header .logoAndName svg{
      width:1.5cm;
      height:1.5cm;
      margin-right:.5cm;
    }
    
    
    /*
    All header elements and paragraphs within the HTML HEADER tag get a margin of 0.
    */
    header h1,
    header h2,
    header h3,
    header p{
      margin:0;
    }
    
    /*
    Heading of level 2 and 3 ("packing slip" and "BILL/SHIP TO") need to be written in 
    uppercase, so we use the text-transform property for that.
    */
    header h2,
    header h3{
      text-transform:uppercase;
    }
    
    header h2{
      font-size:120%;
    }
    
    .formLine {
      display: flex;
      align-items: flex-start;
      margin-left: calc(-1 * var(--gap-size));
      margin-bottom: .5cm;
    }
    
    .formLineWrap {
      flex-wrap: wrap;
    }
    
    .formLine > * {
      padding-left: var(--gap-size);
      box-sizing: border-box;
    }
    
    .lineSubmit {
      text-align: center;
    }
    
    label{
      font-weight:bold;
      color:var(--highlight-color);
    }
    
    label + input[type="text"], label + select {
      margin-top: 2px;
    }
    
    label.sublabel {
      font-size: 0.85em;
      text-transform: uppercase;
      color: var(--secondary-color);
      padding-bottom: 0.25em;
    }
    
    .w100{
      width: 100%;
    }
    
    .w66{
      width:66%;
    }
    
    .w50{
      width:50%;
    }
    
    .w33{
      width:33%;
    }
    
    input[type="text"] {
      width: 100%;
      height: 25px;
    }
    
    select {
      width: 100%;
      height: 25px;
    }
    
    input[type="checkbox"],
    input[type="radio"] {
      margin-right: 4px;
    }
    
    input[type="submit"] {
      background-color: var(--highlight-color);
      color:white;
      font-weight: bold;
      border:none;
      padding:5px;
    }
    
    /*
    The content below the tables is placed in a ASIDE element next to the MAIN element.
    To ensure this element is always at the bottom of the page, just above the page 
    footer, we use the Prince custom property "-prince-float" with the value bottom.
    
    See Page Floats on https://www.princexml.com/howcome/2021/guides/float/.
    */
    aside{
      -prince-float: bottom;
      padding:0 2cm .5cm 2cm;
    }
    
    /*
    The content itself is shown in 2 columns.
    */
    aside p{
      margin:0;
      column-count:2;
    }
    
    /*
    The page footer in our document uses the HTML FOOTER element, we define a height 
    of 3cm matching the margin bottom of the page (see @page rule) and a padding left
    and right of 2cm. We did not give the page itself a margin of 2cm to ensure that
    the background color goes to the edges of the document.
    
    As mentioned above in the comment for the @page the position property with the 
    value running(footer) makes this HTML element float into the bottom left page margin
    box. This page margin box repeats on every page in case we would have a multi-page
    packing slip.
    
    The content inside the footer is aligned with the help of line-height 3cm and a 
    flexbox for the child elements.
    */
    footer{
      height:3cm;
      line-height:3cm;
      padding:0 2cm;
      position:running(footer);
      background-color:var(--table-img-bg-color);
      font-size:8pt;
      display:flex;
      align-items:baseline;
      justify-content:space-between;
    }
    
    /*
    The first link in the footer, which points to the company website is highlighted 
    in bold.
    */
    footer a:first-child{
      font-weight:bold;
    }
    
    </style>

    <!-- The header element will appear on the top of each page of this form document. -->
    <header>
      <div class="headerSection">
        <!-- As a logo we take an SVG element and add the name in an standard H1 element behind it. -->
        <div class="logoAndName">
        
          <img src="{{ asset('LOGO-FSAC.jpg') }}" id="" alt="image" style=" max-width: 230px;max-height: 230px;margin-bottom:5px">
         
        </div>
        <div>
          <h2>Formulaire de préinscription 2024-2025 </h2> <br>
        <div class="form-group centre-content " >
            <b>Formation Continue</b>
        </div><br>
          <p>
            <b>CODE : *******</b> 
          </p>  
        </div>
      </div>
    </header>
    

    <main>
      <form name="application" action="https://en7spkvxc7gii.x.pipedream.net" method="POST">
        <hr />

        <label class="w100 sublabel">FILIÈRE DEMANDÉE :</label>
        <div class="formLine">
        </div>
        <div class="formLine">
          <div class="w33">
            <label>Filière choix  </label>
            <input type="text" name="Filière choix  " />
          </div>
          <div class="w33">
            <label>Filière choix 2 </label>
            <input type="text" name="Filière choix 2 " />
          </div>
          <div class="w33">
            <label>Filière choix 3 </label>
            <input type="text" name="Filière choix 3 " />
          </div>
        </div>
        <hr />
        
        <label class="w100 sublabel">INFORMATIONS PERSONNELLES :</label>
        <div class="formLine">
        </div>
        <div class="formLine">
          <div class="w33">
            <label>NOM</label>
            <input type="text" name="NOM" />
          </div>
          <div class="w33">
            <label>PRENOM</label>
            <input type="text" name="PRENOM" />
          </div>
          <div class="w33">
            <label>Date de naissance</label>
            <input type="text" name="Date de naissance" />
          </div>
        </div>
        <div class="formLine">
          <div class="w33">
            <label> LIEU DE NAISSANCE</label>
            <input type="text" name="LIEU DE NAISSANCE" />
          </div>
          <div class="w33">
            <label>CIN</label>
            <input type="text" name="CIN" />
          </div>
          <div class="w33">
            <label>CNE</label>
            <input type="text" name="CNE" />
          </div>
        </div>
        <div class="formLine">
          <div class="w33">
            <label> TELEPHONE PORTABLE</label>
            <input type="text" name="TELEPHONE PORTABLE" />
          </div>
          
          <div class="w33">
            <label>ADRESSE EMAIL</label>
            <input type="text" name="ADRESSE EMAIL" />
          </div>
    
        </div>
        <div class="formLine">
        
         
        </div>
        <hr />
        
        {{-- <label class="w100 sublabel">FORMATIONS ACADÉMIQUES :</label>
        <div class="formLine">
        </div>
        <div class="formLine">
          
            <div class="w33">
              <label>SÉRIE DU BACCALAURÉAT            </label>
              <input type="text" name="SÉRIE DU BACCALAURÉAT" />
            </div>
            <div class="w33">
              <label>MENTION DU BACCALAURÉAT </label>
              <input type="text" name="MENTION DU BACCALAURÉAT" />
            </div>
            <div class="w33">
              <label>DERNIER DIPLÔME</label>
              <input type="text" name="DERNIER DIPLÔME" />
            </div>
        
          </div>
          <div class="formLine">
          
           
            <div class="w33">
              <label>SPÉCIALITÉ DU DERNIER DIPLÔME</label>
              <input type="text" name="SPÉCIALITÉ DU DERNIER DIPLÔME" />
            </div>
            <div class="w33">
              <label>NOM D'ÉTABLISSEMENT DU DERNIER DIPLÔME</label>
              <input type="text" name="NOM D'ÉTABLISSEMENT DU DERNIER DIPLÔME" />
            </div>
          </div> --}}
       
        {{-- <hr /> --}}
   
    
        <div class="formLine">
        </div>
        {{-- <h2>Date:{{ $date }}</h2> --}}
        <script>
            //  Obtenir la date et l'heure actuelles
var dateActuelle = new Date();

// Afficher la date et l'heure actuelles 
console.log("DATE :", dateActuelle);
</script>






        
      </form>
    </main>
    <!-- Within the aside tag we will put the terms and conditions which will be floated to the bottom page. -->
  
    