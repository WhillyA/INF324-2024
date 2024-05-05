using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace WebApplication4
{
	/// <summary>
	/// Descripción breve de WebService1
	/// </summary>
	[WebService(Namespace = "http://tempuri.org/")]
	[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
	[System.ComponentModel.ToolboxItem(false)]
	// Para permitir que se llame a este servicio web desde un script, usando ASP.NET AJAX, quite la marca de comentario de la línea siguiente. 
	// [System.Web.Script.Services.ScriptService]
	public class WebService1 : System.Web.Services.WebService
	{

		[WebMethod]
		public string HelloWorld()
		{
			return "Hola a todos";
		}
		[WebMethod]
		public DataSet lisatado()
		{
			SqlConnection conn = new SqlConnection();
			conn.ConnectionString = "Data Source=DESKTOP-RPSMGR5; Initial Catalog=bdwhilly; Integrated Security=true;";
			SqlDataAdapter adapter = new SqlDataAdapter("SELECT nombres, ap_pat, ap_mat, ci, direccion FROM persona", conn);
			DataSet datas = new DataSet();
			adapter.Fill(datas);
			return datas;
		}
		[WebMethod]
		public DataSet ingresar(int ci)
		{
			SqlConnection conn = new SqlConnection();
			conn.ConnectionString = "Data Source=DESKTOP-RPSMGR5; Initial Catalog=bdwhilly; Integrated Security=true;";
			SqlDataAdapter adapter = new SqlDataAdapter("SELECT * FROM persona WHERE ci='" + ci + "'", conn);
			DataSet datas = new DataSet();
			adapter.Fill(datas);
			return datas;
		}
		[WebMethod]
		public DataSet Eliminar(int ci)
		{
			SqlConnection conn = new SqlConnection();
			conn.ConnectionString = "Data Source=DESKTOP-RPSMGR5; Initial Catalog=bdwhilly; Integrated Security=true;";

			string query = "SELECT p.nombres, p.ap_pat, p.ap_mat, p.ci, cb.id AS cuenta_id, cb.saldo, cb.fecha_creacion, tc.nombre AS tipo_cuenta FROM cuentabancaria cb INNER JOIN persona p ON cb.id_persona = p.id INNER JOIN tipo_cuenta tc ON cb.id_tipo_cuenta = tc.id WHERE p.ci = @ci";

			SqlDataAdapter adapter = new SqlDataAdapter(query, conn);
			adapter.SelectCommand.Parameters.AddWithValue("@ci", ci); // Uso de parámetro

			DataSet datas = new DataSet();
			adapter.Fill(datas);

			return datas;
		}


	}

}
