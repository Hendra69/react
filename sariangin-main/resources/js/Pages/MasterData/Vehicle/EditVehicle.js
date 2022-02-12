import React from "react";
import { Card, Col, Form, Input, Row } from "antd";
import { Inertia } from "@inertiajs/inertia";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { VehicleForm } from "@/Components/Forms/VehicleForm/VehicleForm";

export default function EditVehicle({ vehicle, vehicleTypes }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.VEHICLES_UPDATE, vehicle.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Data Kendaraan", route: routes.VEHICLES_INDEX },
              { name: "Ubah kendaraan" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Ubah Kendaraan</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <VehicleForm
                    name="edit-vehicle"
                    form={form}
                    onFinish={handleFinish}
                    vehicleTypes={vehicleTypes}
                    initialValues={vehicle}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
