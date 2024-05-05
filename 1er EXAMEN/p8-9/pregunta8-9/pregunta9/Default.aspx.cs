using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class _Default : System.Web.UI.Page
{
	WSconsult_ref.WSconsultasSoapClient lis;
	DataSet ds;


	protected void Page_Load(object sender, EventArgs e)
	{
		lis= new WSconsult_ref.WSconsultasSoapClient();
		ds = lis.Listado();
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();
	}

	protected void GridView1_RowDeleting(object sender, GridViewDeleteEventArgs e)
	{
		GridViewRow row = GridView1.Rows[e.RowIndex];
		int sno = Convert.ToInt32(row.Cells[1].Text);
		lis.EliminarPersona(sno);
		ds = lis.Listado();
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();

	}

	protected void Button1_Click(object sender, EventArgs e)
	{
		// Obtenemos los valores de los TextBox
		string nombres = TextBox2.Text;
		string ap_paterno = TextBox3.Text;
		string ap_materno = TextBox4.Text;
		string ci = TextBox5.Text;
		string direccion = TextBox6.Text;
		DateTime fecha_nac = DateTime.Parse(txtDate.Text);
		string password = Password.Text;  
		lis.AgregarPersona(nombres, ap_paterno, ap_materno, fecha_nac, ci, direccion, password);

		ds = lis.Listado();
		GridView1.DataSource = ds.Tables[0];
		GridView1.DataBind();

		LimpiarFormulario(); 
	}

	private void LimpiarFormulario()
	{
		// Limpia los TextBox después de insertar
		TextBox1.Text = "";
		TextBox2.Text = "";
		TextBox3.Text = "";
		TextBox4.Text = "";
		TextBox5.Text = "";
		TextBox6.Text = "";
		txtDate.Text = "";
		Password.Text = "";
	}

	protected void Button2_Click(object sender, EventArgs e)
	{
		// Obtenemos los valores de los TextBox
		int id = Convert.ToInt32(TextBox1.Text);
		string nombres = TextBox2.Text;
		string ap_paterno = TextBox3.Text;
		string ap_materno = TextBox4.Text;
		string ci = TextBox5.Text;
		string direccion = TextBox6.Text;
		DateTime fecha_nac = DateTime.Parse(txtDate.Text);
		string password = Password.Text;
		string resultado = lis.ActualizarPersona(id, nombres, ap_paterno, ap_materno, fecha_nac, ci, direccion, password);
		
		if (resultado.Contains("Persona actualizada con éxito."))
		{
			ds = lis.Listado();
			GridView1.DataSource = ds.Tables[0];
			GridView1.DataBind();

			LimpiarFormulario();
		}
		else
		{
			TextBox1.Text = "fallo";
		}
		
	}

	protected void GridView1_SelectedIndexChanged(object sender, EventArgs e)
	{
		GridViewRow row = GridView1.SelectedRow;
		TextBox1.Text = row.Cells[1].Text;
		TextBox2.Text = row.Cells[2].Text;
		TextBox3.Text = row.Cells[3].Text;
		TextBox4.Text = row.Cells[4].Text;
		TextBox5.Text = row.Cells[5].Text;
		TextBox6.Text = row.Cells[6].Text;
		string textoCelda = row.Cells[7].Text;
		// Intenta convertir el texto a DateTime
		DateTime fecha;

		bool conversionExitosa = DateTime.TryParse(textoCelda, out fecha);

		if (conversionExitosa)
		{
			// Conversión exitosa, asigna el valor convertido al TextBox
			txtDate.Text = fecha.ToString("yyyy-MM-dd"); // Se puede personalizar el formato
		}
		else
		{
			// Conversión fallida, asigna un mensaje de error o valor predeterminado
			txtDate.Text = "Fecha inválida"; // Manejar el error adecuadamente
		}
	}

	protected void Button3_Click(object sender, EventArgs e)
	{
		LimpiarFormulario();
	}
}