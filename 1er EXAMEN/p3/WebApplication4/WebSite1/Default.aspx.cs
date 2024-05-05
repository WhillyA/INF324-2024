using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class _Default : System.Web.UI.Page
{
	protected void Page_Load(object sender, EventArgs e)
	{
		listar.WebService1SoapClient lis=  new listar.WebService1SoapClient();
		DataSet ds = lis.lisatado();
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();

	}

    protected void TextBox1_TextChanged(object sender, EventArgs e)
    {


    }

	protected void Button1_Click(object sender, EventArgs e)
	{

	}

	protected void Button1_Click1(object sender, EventArgs e)
	{
		listar_persona.WebService1SoapClient lis = new listar_persona.WebService1SoapClient();
		DataSet ds = lis.Eliminar(int.Parse(TextBox1.Text));
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();
	}

	protected void Button2_Click(object sender, EventArgs e)
	{
		listar.WebService1SoapClient lis = new listar.WebService1SoapClient();
		DataSet ds = lis.lisatado();
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();
	}
}