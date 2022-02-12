import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Row } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { DeliveryForm } from "@/Components/Forms/DeliveryForm/DeliveryForm";

export default function CreateDelivery({
  deliveryTypes,
  customers,
  tankCategories,
  drivers,
  vehicles,
}) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.DELIVERIES_STORE), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Surat Jalan", route: routes.DELIVERIES_INDEX },
              { name: "Buat Surat Jalan Baru" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Buat Surat Jalan Baru</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <DeliveryForm
                    name="create-delivery"
                    form={form}
                    onFinish={handleFinish}
                    deliveryTypes={deliveryTypes}
                    customers={customers}
                    tankCategories={tankCategories}
                    drivers={drivers}
                    vehicles={vehicles}
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
