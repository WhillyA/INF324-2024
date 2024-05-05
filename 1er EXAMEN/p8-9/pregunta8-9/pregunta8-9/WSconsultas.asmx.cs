using System;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
using System.Web.Services;
using System.Security.Cryptography;
using System.Collections.Generic;

namespace pregunta8_9
{
	public class DatabaseContext
	{
		private readonly string connectionString;

		public DatabaseContext()
		{
			connectionString = ConfigurationManager.ConnectionStrings["BDWhilly"].ConnectionString;
		}

		public SqlConnection GetConnection()
		{
			return new SqlConnection(connectionString);
		}
	}
	/// <summary>
	/// Descripción breve de WSconsultas
	/// </summary>
	[WebService(Namespace = "http://tempuri.org/")]
	[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
	[System.ComponentModel.ToolboxItem(false)]
	// Para permitir que se llame a este servicio web desde un script, usando ASP.NET AJAX, quite la marca de comentario de la línea siguiente. 
	// [System.Web.Script.Services.ScriptService]
	public class WSconsultas : System.Web.Services.WebService
	{
		private static string HashPassword(string password)
		{
			byte[] salt = new byte[16];
			using (var rng = new RNGCryptoServiceProvider())
			{
				rng.GetBytes(salt);
			}

			using (var rfc = new Rfc2898DeriveBytes(password, salt, 10000))
			{
				byte[] hash = rfc.GetBytes(20);
				byte[] hashBytes = new byte[36];
				Array.Copy(salt, 0, hashBytes, 0, 16);
				Array.Copy(hash, 0, hashBytes, 16, 20);
				return Convert.ToBase64String(hashBytes);
			}
		}
		private readonly DatabaseContext dbContext = new DatabaseContext();
		[WebMethod]
		public DataSet Listado()
		{
			var datas = new DataSet();
			using (var conn = dbContext.GetConnection())
			{
				var adapter = new SqlDataAdapter("SELECT \r\n    p.id, p.nombres, p.ap_pat, p.ap_mat, p.ci, p.direccion, p.fecha_nac, p.password_hash\r\nFROM \r\n    persona p", conn);
				adapter.Fill(datas);
			}
			return datas;
		}
		[WebMethod]
		public string EliminarPersona(int id_persona)
		{
			string result;

			try
			{
				using (SqlConnection conn = dbContext.GetConnection())
				{
					conn.Open();

					// Iniciar una transacción para asegurar consistencia
					using (SqlTransaction transaction = conn.BeginTransaction())
					{
						// Eliminar cuentas bancarias asociadas a la persona
						string deleteCuentasSQL = "DELETE FROM cuentabancaria WHERE id_persona = @id_persona";
						using (SqlCommand cmd = new SqlCommand(deleteCuentasSQL, conn, transaction))
						{
							cmd.Parameters.AddWithValue("@id_persona", id_persona);
							cmd.ExecuteNonQuery();
						}

						// Eliminar persona
						string deletePersonaSQL = "DELETE FROM persona WHERE id = @id_persona";
						using (SqlCommand cmd = new SqlCommand(deletePersonaSQL, conn, transaction))
						{
							cmd.Parameters.AddWithValue("@id_persona", id_persona);
							cmd.ExecuteNonQuery();
						}

						// Confirmar la transacción
						transaction.Commit();
						result = "Persona y sus cuentas bancarias asociadas eliminadas con éxito.";
					}
				}
			}
			catch (Exception ex)
			{
				// En caso de error, revertir la transacción para evitar inconsistencias
				result = $"Error al eliminar persona y sus cuentas bancarias: {ex.Message}";
			}

			return result;
		}

		[WebMethod]
		public string AgregarPersona(string nombres, string ap_pat, string ap_mat, DateTime fecha_nac, string ci, string direccion, string password)
		{
			string result;

			try
			{
				using (SqlConnection conn = dbContext.GetConnection())
				{
					conn.Open();

					using (SqlTransaction transaction = conn.BeginTransaction())
					{
						int id_persona;

						// Insertar persona y obtener el último ID
						string insertPersonaSQL = "INSERT INTO persona (nombres, ap_pat, ap_mat, fecha_nac, ci, direccion, password_hash, id_rol_usuario) OUTPUT INSERTED.ID VALUES (@nombres, @ap_pat, @ap_mat, @fecha_nac, @ci, @direccion, @password_hash, @id_rol_usuario)";
						using (SqlCommand cmd = new SqlCommand(insertPersonaSQL, conn, transaction))
						{
							// Hashear la contraseña
							string password_hash = HashPassword(password);
							int id_rol_usuario = 3;

							// Agregar parámetros
							cmd.Parameters.AddWithValue("@nombres", nombres);
							cmd.Parameters.AddWithValue("@ap_pat", ap_pat);
							cmd.Parameters.AddWithValue("@ap_mat", ap_mat);
							cmd.Parameters.AddWithValue("@fecha_nac", fecha_nac);
							cmd.Parameters.AddWithValue("@ci", ci);
							cmd.Parameters.AddWithValue("@direccion", direccion);
							cmd.Parameters.AddWithValue("@password_hash", password_hash);
							cmd.Parameters.AddWithValue("@id_rol_usuario", id_rol_usuario);

							// Ejecutar y obtener el ID recién insertado
							id_persona = Convert.ToInt32(cmd.ExecuteScalar());
						}

						

						// Confirmar la transacción
						transaction.Commit();
						result = "Persona y cuenta bancaria agregadas con éxito.";
					}
				}
			}
			catch (Exception ex)
			{
				result = $"Error al agregar persona y cuenta bancaria: {ex.Message}";
			}

			return result;
		}

		[WebMethod]
		public string ActualizarPersona(int id_persona, string nombres, string ap_pat, string ap_mat, DateTime fecha_nac, string ci, string direccion, string password)
		{
			string result;

			try
			{
				using (SqlConnection conn = dbContext.GetConnection())
				{
					conn.Open();

					using (SqlTransaction transaction = conn.BeginTransaction())
					{
						// Sentencia SQL para actualizar información de una persona
						string updatePersonaSQL = "UPDATE persona SET nombres = @nombres, ap_pat = @ap_pat, ap_mat = @ap_mat, fecha_nac = @fecha_nac, ci = @ci, direccion = @direccion, password_hash = @password_hash WHERE id = @id_persona";

						using (SqlCommand cmd = new SqlCommand(updatePersonaSQL, conn, transaction))
						{
							// Hashear la contraseña
							string password_hash = HashPassword(password);

							// Agregar parámetros
							cmd.Parameters.AddWithValue("@id_persona", id_persona);
							cmd.Parameters.AddWithValue("@nombres", nombres);
							cmd.Parameters.AddWithValue("@ap_pat", ap_pat);
							cmd.Parameters.AddWithValue("@ap_mat", ap_mat);
							cmd.Parameters.AddWithValue("@fecha_nac", fecha_nac);
							cmd.Parameters.AddWithValue("@ci", ci);
							cmd.Parameters.AddWithValue("@direccion", direccion);
							cmd.Parameters.AddWithValue("@password_hash", password_hash);

							// Ejecutar el comando
							int filasAfectadas = cmd.ExecuteNonQuery();

							if (filasAfectadas == 0)
							{
								throw new Exception("Persona no encontrada para actualización.");
							}
						}

						// Confirmar la transacción
						transaction.Commit();
						result = "Persona actualizada con éxito.";
					}
				}
			}
			catch (Exception ex)
			{
				// Manejar errores y deshacer la transacción
				result = $"Error al actualizar persona: {ex.Message}";
			}

			return result;
		}

	}
}
